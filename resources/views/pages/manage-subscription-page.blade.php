<x-filament::page>
    <x-filament-subscriptions::plan-details :name="$name" :features="$features"/>
    <div class="m-4 text-center">
        <ul role="list" class="grid gap-8 sm:grid-cols-2 xl:grid-cols-3 sm:gap-y-16 xl:col-span-2">
            @foreach ($subscriptions as $subscription)
                <x-filament-subscriptions::card 
                :name="$subscription->name"
                :trial="$subscription->plan->trial_interval"
                />
            @endforeach
        </ul>
    </div>
</x-filament::page>