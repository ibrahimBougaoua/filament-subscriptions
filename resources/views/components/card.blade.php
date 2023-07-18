@props([
    'name' => $name,
    'price' => $price,
    'trial' => $trial,
    'starts_at' => '',
    'ends_at' => '',
    'state' => 'Actived',
    'isTrial' => false,
    'isActive' => false,
    'isCanceled' => false,
    'isExpired' => false,
])
<li>
    <div class="gap-x-6 sm:w-1/2 lg:w-1/3 w-full hover:scale-105 duration-500">
        <div class="flex items-center justify-between p-4 rounded-lg bg-white shadow-md">
            <div>
                <h2 class="text-left ext-gray-900 text-lg font-bold">{{ $name }}</h2>
                <h3 class="mt-2 text-xl font-bold text-yellow-500 text-left">{{ $price }} {{ config('filament-subscriptions.currency') }}</h3>
                <h2 class="mt-2 text-xl font-bold text-yellow-500 text-left uppercase">{{ $trial }}</h2>
                <a class="filament-button filament-button-size-md inline-flex items-center justify-center mt-3 py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-success-600 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 filament-page-button-action">
                    @if($isTrial) Free @else Paid @endif
                </a>
            </div>
            <div @class([
                'bg-gradient-to-tr w-32 h-32 rounded-full shadow-2xl border-white border-dashed border-2 flex justify-center items-center',
                'bg-success-600' => $isActive,
                'bg-danger-600' => $isCanceled,
                'bg-primary-600' => $isExpired && ! $isCanceled,
                ])>
                <div>
                    <h1 class="text-white text-2xl">{{ $state }}</h1>
                </div>
            </div>
        </div>
    </div>
</li>