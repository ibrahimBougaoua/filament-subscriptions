<x-filament-panels::page>
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
</x-filament-panels::page>