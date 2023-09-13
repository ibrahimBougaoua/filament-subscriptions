<x-filament-panels::page>
    @if(count($plans))
        <div class="flex flex-col xl:flex-row gap-4">
            @php
                $hasSubscribed = auth()->user()->hasSubscribedToTrial();
            @endphp
            @foreach ($plans as $plan)
                @php
                    $hasSubscribedTo = auth()->user()->hasSubscribedTo($plan->id);
                    $hasSubscribedToTrial = auth()->user()->hasSubscribedToTrial() && ($plan->period == 'Trial');
                @endphp
                <div @class([
                        'w-25 border border-gray-200 p-5 rounded-xl',
                        'bg-primary-600 hover:scale-105 duration-500' => $hasSubscribedTo,
                        'bg-white dark:bg-gray-900 dark:ring-white/10 hover:scale-105 duration-500' => ! $hasSubscribedTo && ! $hasSubscribedToTrial,
                        'bg-gray-500 text-white dark:bg-gray-400 dark:ring-white/10' => $hasSubscribedToTrial
                    ])>
                    <div class="px-6 py-5 sm:p-10 sm:pb-6">
                        <div class="flex justify-center">
                            <span @class([
                                    'inline-flex text-xl px-4 py-1 rounded-full leading-5 font-semibold tracking-wide uppercase',
                                    'text-white' => $hasSubscribedTo
                                ])>
                                {{ $plan->name }}
                            </span>
                        </div>
                        <div @class([
                                'mt-4 flex justify-center text-xl leading-none font-extrabold',
                                'text-white' => $hasSubscribedTo
                            ])>
                            {{ $plan->price }} {{ config('filament-subscriptions.currency') }}
                            <span @class([
                                    'text-xl leading-8 font-medium',
                                    'text-white' => $hasSubscribedTo
                                ])>
                                / {{ $plan->period }}
                            </span>
                        </div>
                    </div>
                    <p @class([
                            'mt-0',
                            'text-white' => $hasSubscribedTo,
                            'text-md' => ! $hasSubscribedTo
                        ])>
                        {{ __('ui.plan_include') }}
                    </p>
                    <ul class="text-sm w-full py-3">
                        @foreach ($features as $feature)
                            @php
                                $status = auth()->user()->hasFeature($plan->id,$feature->id);
                            @endphp
                            <x-filament-subscriptions::feature 
                                :selected="$hasSubscribedTo" 
                                :status="$status" 
                                :name="$feature->name"
                            />
                        @endforeach
                    </ul>
                    @php
                        $classes = \Illuminate\Support\Arr::toCssClasses([
                            'w-full filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none',
                            'text-white border-primary-500 dark:bg-primary-500 dark:ring-primary-500' => $hasSubscribedTo,
                            'text-gray border-gray-300' => ! $hasSubscribedTo
                        ]);
                    @endphp
                    @if($hasSubscribedTo)
                        <button type="button" @class([
                                $classes,
                            ])
                            disabled
                            >
                            {{ __('ui.currently_active') }}
                        </button>
                    @elseif(!$hasSubscribedTo && !$hasSubscribedToTrial)
                        <button type="button" @class([
                                $classes,
                            ])
                            wire:click="switchPlan({{ $plan->id }})"
                            >
                            {{ __('ui.switch_plan') }}
                        </button>
                    @else
                        <button type="button" @class([
                                $classes,
                            ])
                            disabled
                            >
                            {{ __('ui.allready_used') }}
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="fi-section rounded-xl w-full justify-center bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-ta-empty-state-content mx-auto grid max-w-lg justify-items-center text-center">
                <div class="p-5">
                    <h2 class="mx-auto">{{ __('ui.no_plan_found') }}</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="250" height="250">
                        <path fill="#D17A00" d="M10 7H38V14H10z" />
                        <path fill="#8A5100" d="M10 21L6 21 6 13 10 7zM38 21L42 21 42 13 38 7z" />
                        <path fill="#FF9800" d="M40,41H8c-1.1,0-2-0.9-2-2V13h36v26C42,40.1,41.1,41,40,41z" />
                        <path fill="#8A5100" d="M27.5,20h-7c-0.8,0-1.5-0.7-1.5-1.5v0c0-0.8,0.7-1.5,1.5-1.5h7c0.8,0,1.5,0.7,1.5,1.5v0C29,19.3,28.3,20,27.5,20z" />
                    </svg>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>