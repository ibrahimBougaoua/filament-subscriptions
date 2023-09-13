<x-filament-panels::page>
    @if(count($subscriptions))
        @if(!$saw_it)
            <x-filament-subscriptions::alert
            :message="$message" 
            />
        @endif
        <x-filament-subscriptions::plan-details 
            :name="$name" 
            :price="$price" 
            :period="$period" 
            :description="$description" 
            :isTrial="$isTrial"
            :isPaid="$isPaid"
            :features="$features"
        />
        <div class="m-4 text-center">
            <ul role="list" class="grid gap-8 xl:grid-cols-3 lg:grid-cols-3">
                @foreach ($subscriptions as $subscription)
                    <x-filament-subscriptions::card 
                        :name="$subscription->name"
                        :image="$subscription->plan->image"
                        :price="$subscription->price"
                        :starts_at="$subscription->starts_at"
                        :ends_at="$subscription->ends_at"
                        :trial="$subscription->plan->period"
                        :state="$subscription->planState()"
                        :isActive="$subscription->active()"
                        :isTrial="$subscription->isFreeSubscription()"
                        :isCanceled="$subscription->canceled()"
                        :isExpired="$subscription->expired()"
                    />
                @endforeach
            </ul>
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
                    <a href="{{ route('filament.admin.pages.plans-page') }}" class="w-full filament-button filament-button-size-lg inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-500 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 filament-page-button-action">
                        <span class="text-white font-semibold">
                            {{ __('ui.upgrade_plan') }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>