@props([
    'name' => 'Plan',
    'price' => '0000.00',
    'trial_interval' => 'Month',
    'description' => '',
    'isTrial' => false,
    'features' => [],
])
<div class="bg-gradient-to-b from-pink-100 to-purple-200">
    <div class="container m-auto px-2">
        <div class="mt-12 m-auto -space-y-4 items-center md:flex md:space-y-0 md:-space-x-4 xl:w-10/12">
            <div class="relative z-10 -mx-4 group md:w-6/12 md:mx-0 lg:w-5/12">
                <div aria-hidden="true" class="absolute top-0 w-full h-full rounded-2xl bg-white shadow-xl transition duration-500 group-hover:scale-105 lg:group-hover:scale-110"></div>
                <div class="relative p-6 space-y-6 lg:p-8">
                    <h3 class="text-3xl text-gray-700 font-semibold text-center">
                        {{ $name }}
                    </h3>
                    <h3 class="mt-2 text-xl font-bold text-yellow-500 text-center">
                        @if( $isTrial ) 
                            0000.00
                        @else
                            {{ $price }} 
                        @endif
                        {{ config('filament-subscriptions.currency') }} / {{ $trial_interval }}
                    </h3>
                    <div @class([
                        'bg-gradient-to-tr w-32 h-32 rounded-full shadow-2xl border-white border-dashed border-2 flex justify-center items-center',
                        'bg-gray-600' => $isTrial,
                        'bg-success-600' => ! $isTrial,
                        ])>
                        <div>
                            <h1 class="text-white text-2xl">
                                @if( $isTrial )
                                    Free
                                @else
                                    Paid
                                @endif
                            </h1>
                        </div>
                    </div>
                    <a href="{{ route('filament.pages.plans-page') }}" class="w-full filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-success-600 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 filament-page-button-action">
                        <span class="text-white font-semibold">
                            Upgrade Plan
                        </span>
                    </a>
                </div>
            </div>

            <div class="relative group w-full">
                <div aria-hidden="true" class="absolute top-0 w-full h-full rounded-2xl bg-white shadow-lg transition duration-500 group-hover:scale-105"></div>
                <div class="relative p-6 pt-16 md:p-8 md:pl-12 md:rounded-r-2xl lg:pl-20 lg:p-16">
                    <ul role="list" class="columns-1 lg:columns-4 filament-forms-checkbox-list-component gap-1 space-y-2">
                        @foreach ($features as $feature)
                            <li class="space-x-2">
                                <span class="text-purple-500 font-semibold">&check;</span>
                                <span>{{ $feature->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <p class="text-gray-700 py-8">{{ $description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>