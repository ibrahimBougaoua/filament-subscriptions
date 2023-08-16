@props([
    'name' => $name,
    'image' => $image,
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
        <div class="flex items-center justify-between p-4 rounded-lg bg-white shadow-md dark:bg-gray-900 dark:ring-white/10">
            <div>
                <h2 class="text-left ext-gray-900 text-lg font-bold">{{ $name }}</h2>
                <h3 class="mt-2 text-xl font-bold text-yellow-500 text-left">{{ $price }} {{ config('filament-subscriptions.currency') }}</h3>
                <h2 class="mt-2 text-xl font-bold text-yellow-500 text-left uppercase">{{ $trial }}</h2>
                <a @class([
                    'filament-button filament-button-size-md inline-flex items-center justify-center mt-3 py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 filament-page-button-action',
                    'bg-gray-600' => $isTrial,
                    'bg-primary-600' => ! $isTrial,
                    ])>
                    @if($isTrial) {{ __('ui.free') }} @else {{ __('ui.paid') }} @endif
                </a>
            </div>
            <div class='w-32 rounded-full shadow-3xl flex justify-center items-center'>
                <div style="background-image: url('/storage/{{ $image }}');" class="fi-avatar bg-cover bg-center h-32 w-32 fi-user-avatar rounded-full">
                </div>
            </div>
        </div>
    </div>
</li>