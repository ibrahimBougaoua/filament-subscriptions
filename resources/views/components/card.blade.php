@props([
    'name' => $name,
    'trial' => $trial,
])
<li>
    <div class="gap-x-6 sm:w-1/2 lg:w-1/3 w-full hover:scale-105 duration-500">
        <div class="flex items-center justify-between p-4 rounded-lg bg-white shadow-md">
            <div>
                <h2 class="text-left ext-gray-900 text-lg font-bold">{{ $name }}</h2>
                <h3 class="mt-2 text-xl font-bold text-yellow-500 text-left">{{ $trial }}</h3>
                <p class="text-sm font-semibold text-gray-400">Last Transaction</p>
                <button class="text-left text-sm mt-6 px-4 py-2 bg-primary-500 text-white rounded-lg  tracking-wider hover:bg-yellow-300 outline-none">{{ $trial }}</button>
            </div>
            <div class="bg-gradient-to-tr bg-success-500 w-32 h-32 rounded-full shadow-2xl border-white border-dashed border-2 flex justify-center items-center ">
                <div>
                    <h1 class="text-white text-2xl">{{ $name }}</h1>
                </div>
            </div>
        </div>
    </div>
</li>