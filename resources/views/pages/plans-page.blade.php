<x-filament-panels::page>
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
</x-filament-panels::page>