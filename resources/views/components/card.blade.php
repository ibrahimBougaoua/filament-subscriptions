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
                    @if($isTrial) Free @else Paid @endif
                </a>
            </div>
            <div class='w-32 h-32 rounded-full shadow-3xl flex justify-center items-center'>
                @if($isActive)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="240" height="240">
                        <linearGradient id="I9GV0SozQFknxHSR6DCx5a" x1="9.858" x2="38.142" y1="9.858" y2="38.142" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="#21ad64" />
                        <stop offset="1" stop-color="#088242" />
                        </linearGradient>
                        <path fill="url(#I9GV0SozQFknxHSR6DCx5a)" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z" />
                        <path d="M32.172,16.172L22,26.344l-5.172-5.172c-0.781-0.781-2.047-0.781-2.828,0l-1.414,1.414c-0.781,0.781-0.781,2.047,0,2.828l8,8c0.781,0.781,2.047,0.781,2.828,0l13-13c0.781-0.781,0.781-2.047,0-2.828L35,16.172C34.219,15.391,32.953,15.391,32.172,16.172z" opacity=".05" />
                        <path d="M20.939,33.061l-8-8c-0.586-0.586-0.586-1.536,0-2.121l1.414-1.414c0.586-0.586,1.536-0.586,2.121,0L22,27.051l10.525-10.525c0.586-0.586,1.536-0.586,2.121,0l1.414,1.414c0.586,0.586,0.586,1.536,0,2.121l-13,13C22.475,33.646,21.525,33.646,20.939,33.061z" opacity=".07" />
                        <path fill="#fff" d="M21.293,32.707l-8-8c-0.391-0.391-0.391-1.024,0-1.414l1.414-1.414c0.391-0.391,1.024-0.391,1.414,0L22,27.758l10.879-10.879c0.391-0.391,1.024-0.391,1.414,0l1.414,1.414c0.391,0.391,0.391,1.024,0,1.414l-13,13C22.317,33.098,21.683,33.098,21.293,32.707z" />
                    </svg>
                @elseif($isCanceled)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="240" height="240">
                        <linearGradient id="wRKXFJsqHCxLE9yyOYHkza" x1="9.858" x2="38.142" y1="9.858" y2="38.142" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="#f44f5a" />
                        <stop offset=".443" stop-color="#ee3d4a" />
                        <stop offset="1" stop-color="#e52030" />
                        </linearGradient>
                        <path fill="url(#wRKXFJsqHCxLE9yyOYHkza)" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z" />
                        <path d="M33.192,28.95L28.243,24l4.95-4.95c0.781-0.781,0.781-2.047,0-2.828l-1.414-1.414c-0.781-0.781-2.047-0.781-2.828,0L24,19.757l-4.95-4.95c-0.781-0.781-2.047-0.781-2.828,0l-1.414,1.414c-0.781,0.781-0.781,2.047,0,2.828l4.95,4.95l-4.95,4.95c-0.781,0.781-0.781,2.047,0,2.828l1.414,1.414c0.781,0.781,2.047,0.781,2.828,0l4.95-4.95l4.95,4.95c0.781,0.781,2.047,0.781,2.828,0l1.414-1.414C33.973,30.997,33.973,29.731,33.192,28.95z" opacity=".05" />
                        <path d="M32.839,29.303L27.536,24l5.303-5.303c0.586-0.586,0.586-1.536,0-2.121l-1.414-1.414c-0.586-0.586-1.536-0.586-2.121,0L24,20.464l-5.303-5.303c-0.586-0.586-1.536-0.586-2.121,0l-1.414,1.414c-0.586,0.586-0.586,1.536,0,2.121L20.464,24l-5.303,5.303c-0.586,0.586-0.586,1.536,0,2.121l1.414,1.414c0.586,0.586,1.536,0.586,2.121,0L24,27.536l5.303,5.303c0.586,0.586,1.536,0.586,2.121,0l1.414-1.414C33.425,30.839,33.425,29.889,32.839,29.303z" opacity=".07" />
                        <path fill="#fff" d="M31.071,15.515l1.414,1.414c0.391,0.391,0.391,1.024,0,1.414L18.343,32.485c-0.391,0.391-1.024,0.391-1.414,0l-1.414-1.414c-0.391-0.391-0.391-1.024,0-1.414l14.142-14.142C30.047,15.124,30.681,15.124,31.071,15.515z" />
                        <path fill="#fff" d="M32.485,31.071l-1.414,1.414c-0.391,0.391-1.024,0.391-1.414,0L15.515,18.343c-0.391-0.391-0.391-1.024,0-1.414l1.414-1.414c0.391-0.391,1.024-0.391,1.414,0l14.142,14.142C32.876,30.047,32.876,30.681,32.485,31.071z" />
                    </svg>
                @elseif ($isExpired && ! $isCanceled)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="480" height="480">
                        <path fill="#fff" d="M7,24c0,9.4,7.6,17,17,17s17-7.6,17-17c0-9.4-7.6-17-17-17S7,14.6,7,24" />
                        <path fill="#dcedc8" d="M24,44C13,44,4,35,4,24C4,13,13,4,24,4c4.7,0,9.3,1.7,12.9,4.8l-2.6,3C31.5,9.3,27.8,8,24,8 C15.2,8,8,15.2,8,24s7.2,16,16,16V44z" />
                        <path fill="#7cb342" d="M27 12L19 6 27 0z" />
                        <path fill="#b0bec5" d="M11,24c0,0.6-0.4,1-1,1H7v-2h3C10.6,23,11,23.4,11,24z M24,37c-0.6,0-1,0.4-1,1v3h2v-3 C25,37.4,24.6,37,24,37z M38,23c-0.6,0-1,0.4-1,1s0.4,1,1,1h3v-2H38z" />
                        <path fill="#7cb342" d="M24,44C13,44,4,35,4,24c0-4.7,1.7-9.3,4.8-12.9l3,2.6C9.3,16.5,8,20.2,8,24c0,8.8,7.2,16,16,16 s16-7.2,16-16S32.8,8,24,8V4c11,0,20,9,20,20C44,35,35,44,24,44z" />
                        <path fill="#546e7a" d="M32.8,21.3c0,0.6-0.1,1.1-0.4,1.5c-0.3,0.4-0.7,0.8-1.2,1c0.6,0.3,1,0.6,1.3,1.1s0.5,1,0.5,1.7 c0,1-0.4,1.9-1.1,2.5c-0.7,0.6-1.7,0.9-3,0.9c-1.3,0-2.3-0.3-3-0.9c-0.7-0.6-1.1-1.4-1.1-2.5c0-0.6,0.2-1.2,0.5-1.7s0.8-0.9,1.4-1.1 c-0.5-0.3-0.9-0.6-1.2-1c-0.3-0.4-0.4-0.9-0.4-1.5c0-1,0.3-1.8,1-2.4c0.7-0.6,1.6-0.9,2.8-0.9c1.2,0,2.1,0.3,2.8,0.9 C32.4,19.5,32.8,20.3,32.8,21.3z M30.3,26.4c0-0.5-0.1-0.9-0.4-1.1c-0.2-0.3-0.6-0.4-1-0.4c-0.4,0-0.7,0.1-1,0.4 c-0.3,0.3-0.4,0.6-0.4,1.1s0.1,0.8,0.4,1.1c0.3,0.3,0.6,0.4,1,0.4c0.4,0,0.7-0.1,1-0.4C30.2,27.2,30.3,26.9,30.3,26.4z M28.9,20.1 c-0.4,0-0.6,0.1-0.8,0.4c-0.2,0.2-0.3,0.6-0.3,1s0.1,0.8,0.3,1c0.2,0.3,0.5,0.4,0.8,0.4c0.4,0,0.6-0.1,0.8-0.4s0.3-0.6,0.3-1 s-0.1-0.7-0.3-1C29.6,20.2,29.3,20.1,28.9,20.1z M21.6,26h1.2v2h-1.2v2h-2.8v-2h-4.6L14,26.4l4.8-8.4h2.8C21.6,18,21.6,26,21.6,26z M16.6,26h2.2v-4.4l-0.2,0.3L16.6,26z" />
                    </svg>
                @endif
            </div>
        </div>
    </div>
</li>