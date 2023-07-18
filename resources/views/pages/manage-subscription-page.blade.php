<x-filament::page>
    <x-filament-subscriptions::plan-details 
    :name="$name" 
    :price="$price" 
    :trial_interval="$trial_interval" 
    :description="$description" 
    :isTrial="$isTrial"
    :features="$features"
    />
    <div class="m-4 text-center">
        <ul role="list" class="grid gap-8 sm:grid-cols-2 xl:grid-cols-3 sm:gap-y-16 xl:col-span-2">
            @foreach ($subscriptions as $subscription)
                <x-filament-subscriptions::card 
                :name="$subscription->name"
                :price="$subscription->price"
                :starts_at="$subscription->starts_at"
                :ends_at="$subscription->ends_at"
                :trial="$subscription->plan->trial_interval"
                :state="$subscription->planState()"
                :isActive="$subscription->active()"
                :isTrial="$subscription->isFreeSubscription()"
                :isCanceled="$subscription->canceled()"
                :isExpired="$subscription->expired()"
                />
            @endforeach
        </ul>
    </div>
</x-filament::page>