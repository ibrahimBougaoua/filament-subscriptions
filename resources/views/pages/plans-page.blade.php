<x-filament::page>
    <div class="grid gap-8 sm:grid-cols-2 xl:grid-cols-5 sm:gap-y-16 xl:col-span-2">
        @foreach ($plans as $plan)
            <div @class([
                'gap-x-6 sm:w-1/2 lg:w-1/3 w-full p-3 rounded-xl hover:scale-105 duration-500',
                'bg-success-500' => auth()->user()->hasSubscribedTo($plan->id),
                'bg-white' => ! auth()->user()->hasSubscribedTo($plan->id)
                ])>
                <div class="px-6 py-5 sm:p-10 sm:pb-6">
                    <div class="flex justify-center">
                        <span @class([
                            'inline-flex text-xl px-4 py-1 rounded-full leading-5 font-semibold tracking-wide uppercase',
                            'text-white' => auth()->user()->hasSubscribedTo($plan->id)
                            ])>
                            {{ $plan->name }}
                        </span>
                    </div>
                    <div @class([
                        'mt-4 flex justify-center text-xl leading-none font-extrabold',
                        'text-white' => auth()->user()->hasSubscribedTo($plan->id)
                        ])>
                        {{ $plan->price }} {{ config('filament-subscriptions.currency') }}
                        <span @class([
                            'text-xl leading-8 font-medium',
                            'text-white' => auth()->user()->hasSubscribedTo($plan->id),
                            'text-gray-500' => ! auth()->user()->hasSubscribedTo($plan->id)
                            ])>
                            / {{ $plan->trial_interval }}
                        </span>
                    </div>
                </div>
                <p @class([
                    'mt-0',
                    'text-white' => auth()->user()->hasSubscribedTo($plan->id),
                    'text-md' => ! auth()->user()->hasSubscribedTo($plan->id)
                    ])>
                    Plan include :
                </p>
                <ul class="text-sm w-full py-3">
                    @foreach ($features as $feature)
                        <x-filament-subscriptions::feature 
                        :selected="auth()->user()->hasSubscribedTo($plan->id)" 
                        :status="auth()->user()->hasFeature($plan->id,$feature->id)" 
                        :name="$feature->name"
                        />
                    @endforeach
                </ul>
                <button type="button" @class([
                    'w-full filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm  dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:text-gray-200 dark:focus:text-primary-400 dark:focus:border-primary-400 dark:focus:bg-gray-800 filament-page-button-action',
                    'bg-success-300 text-white border-success-300 hover:bg-success-50 focus:ring-success-600 focus:text-success-600 focus:bg-success-50 focus:border-success-600' => auth()->user()->hasSubscribedTo($plan->id),
                    'bg-white text-gray-800 border-gray-300 hover:bg-gray-50 focus:ring-primary-600 focus:text-primary-600 focus:bg-primary-50 focus:border-primary-600' => ! auth()->user()->hasSubscribedTo($plan->id)
                    ])>
                    @if(auth()->user()->hasSubscribedTo($plan->id))
                        Currently Active
                    @else
                        Switch Plan
                    @endif
                </button>
            </div>
        @endforeach
    </div>
</x-filament::page>