@props([
    'name' => 'Plan',
    'price' => '0000.00',
    'period' => 'Month',
    'description' => '',
    'isTrial' => false,
    'isPaid' => false,
    'features' => [],
])
<div class="bg-gradient-to-b from-pink-100 to-purple-200">
    <div class="container m-auto px-2">
        <div class="m-auto -space-y-4 items-center md:flex md:space-y-0 md:-space-x-4 xl:w-10/12">
            <div class="relative z-10 -mx-4 group md:w-6/12 md:mx-0">
                <div aria-hidden="true" class="absolute top-0 w-full h-full rounded-4xl bg-white shadow-xl transition duration-500 group-hover:scale-105 lg:group-hover:scale-110 lg:w-5/12 dark:bg-gray-900 dark:ring-white/10"></div>
                <div class="relative p-6 space-y-6 lg:p-8">
                    <h3 class="text-3xl text-gray-700 font-semibold text-center dark:text-white">
                        {{ $name }}
                    </h3>
                    <h3 class="mt-2 text-xl font-bold text-yellow-500 text-center">
                        @if( $isTrial )
                            0000.00
                        @else
                            {{ $price }}
                        @endif
                        {{ config('filament-subscriptions.currency') }} / {{ $period }}
                    </h3>
                    <div class='bg-gradient-to-tr mx-5 w-32 h-32 rounded-full shadow-2xl border-white border-dashed border-2 flex justify-center items-center'>
                        <h1 class="text-gray text-2xl">
                            @if( ! $isPaid && ! $isTrial)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="120" height="120">
                                    <linearGradient id="TA8gJDC320v9~4Ug~8Lxfa" x1="9.858" x2="38.142" y1="9.858" y2="38.142" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#33bef0" />
                                    <stop offset="1" stop-color="#0a85d9" />
                                    </linearGradient>
                                    <path fill="url(#TA8gJDC320v9~4Ug~8Lxfa)" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z" />
                                    <path d="M25,17v14c0,1.105,0.895,2,2,2h2c1.105,0,2-0.895,2-2V17c0-1.105-0.895-2-2-2h-2C25.895,15,25,15.895,25,17z" opacity=".05" />
                                    <path d="M29,32.5h-2c-0.828,0-1.5-0.672-1.5-1.5V17c0-0.828,0.672-1.5,1.5-1.5h2c0.828,0,1.5,0.672,1.5,1.5v14C30.5,31.828,29.828,32.5,29,32.5z" opacity=".07" />
                                    <path d="M17,17v14c0,1.105,0.895,2,2,2h2c1.105,0,2-0.895,2-2V17c0-1.105-0.895-2-2-2h-2C17.895,15,17,15.895,17,17z" opacity=".05" />
                                    <path d="M21,32.5h-2c-0.828,0-1.5-0.672-1.5-1.5V17c0-0.828,0.672-1.5,1.5-1.5h2c0.828,0,1.5,0.672,1.5,1.5v14C22.5,31.828,21.828,32.5,21,32.5z" opacity=".07" />
                                    <path fill="#fff" d="M22,17v14c0,0.552-0.448,1-1,1h-2c-0.552,0-1-0.448-1-1V17c0-0.552,0.448-1,1-1h2C21.552,16,22,16.448,22,17z" />
                                    <path fill="#fff" d="M30,17v14c0,0.552-0.448,1-1,1h-2c-0.552,0-1-0.448-1-1V17c0-0.552,0.448-1,1-1h2C29.552,16,30,16.448,30,17z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="120" height="120">
                                    <path fill="#4caf50" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z" />
                                    <path fill="#ccff90" d="M34.602,14.602L21,28.199l-5.602-5.598l-2.797,2.797L21,33.801l16.398-16.402L34.602,14.602z" />
                                </svg>
                            @endif
                        </h1>
                    </div>
                    <a href="{{ route('filament.admin.pages.plans-page') }}" class="w-full filament-button filament-button-size-lg inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-500 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 filament-page-button-action">
                        <span class="text-white font-semibold">
                            {{ __('ui.upgrade_plan') }}
                        </span>
                    </a>
                </div>
            </div>

            <div class="relative group w-full">
                <div aria-hidden="true" class="absolute top-0 w-full h-full rounded-2xl bg-white shadow-lg transition duration-500 group-hover:scale-105 dark:bg-gray-900 dark:ring-white/10"></div>
                <div class="relative p-6 pt-16 md:p-8 md:pl-12 md:rounded-r-2xl lg:pl-20 lg:p-16">
                    <ul role="list" class="grid xl:grid-cols-3 lg:grid-cols-3">
                        @foreach ($features as $feature)
                            <li class="space-x-2">
                                <span class="text-purple-500 font-semibold">&check;</span>
                                <span>{{ $feature->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <p class="text-gray-700 py-8 dark:text-white">{{ $description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>