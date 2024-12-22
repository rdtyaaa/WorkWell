<x-app-layout>

    <div class="flex grid h-48 grid-cols-6 items-center overflow-x-hidden bg-sky-600 object-cover">
        <svg class="flex h-full -translate-x-32 justify-start" xmlns="http://www.w3.org/2000/svg" width="400"
            height="300" viewBox="0 0 124 100" fill="none">
            <path
                d="M19.375 36.7818V100.625C19.375 102.834 21.1659 104.625 23.375 104.625H87.2181C90.7818 104.625 92.5664 100.316 90.0466 97.7966L26.2034 33.9534C23.6836 31.4336 19.375 33.2182 19.375 36.7818Z"
                fill="#075985" />
            <circle cx="90" cy="30" r="18.1641" fill="#c026d3" />
            <circle cx="100" cy="70" r="10" fill="#082f49" />
        </svg>
        <form class="col-span-4 mx-auto flex items-end gap-8">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative flex w-full flex-wrap">
                <label class="mb-2 text-white" for="job-search">Kerja Apa?</label>
                <input type="text" name="job-search" id="simple-search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Programmer" />
            </div>
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative flex w-full flex-wrap">
                <label class="mb-2 text-white" for="job-search">Dimana?</label>
                <input type="text" name="job-search" id="simple-search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Jakarta" />
            </div>
            <button type="submit"
                class="h-fit rounded-lg border border-fuchsia-700 bg-fuchsia-700 px-6 py-2.5 text-sm font-medium text-white hover:bg-fuchsia-800 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 dark:bg-fuchsia-600 dark:hover:bg-fuchsia-700 dark:focus:ring-fuchsia-800">
                Search
            </button>
        </form>
        <svg class="flex h-full rotate-180 justify-start" xmlns="http://www.w3.org/2000/svg" width="400"
            height="300" viewBox="0 0 124 100" fill="none">
            <path
                d="M19.375 36.7818V100.625C19.375 102.834 21.1659 104.625 23.375 104.625H87.2181C90.7818 104.625 92.5664 100.316 90.0466 97.7966L26.2034 33.9534C23.6836 31.4336 19.375 33.2182 19.375 36.7818Z"
                fill="#082f49" />
            <circle cx="90" cy="40" r="18.1641" fill="#0369a1" />
            <circle cx="150" cy="70" r="10" fill="#075985" />
        </svg>
    </div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div id="title">
                <h1 class="text-xl font-semibold text-gray-800">Temukan Peluang Karier Impian Anda</h1>
                <p class="text-sm text-gray-500">Temukan pekerjaan yang sesuai dengan keterampilan dan minat Anda,
                    dapatkan rekomendasi karier terbaik, dan lamar pekerjaan dengan mudah.</p>
            </div>

            <x-card :image="'/docs/images/products/apple-watch.png'" :title="'Apple Watch Series 7 GPS, Aluminium Case, Starlight Sport'" :rating="'5.0'" :price="'$599'" :buttonText="'Add to cart'" />


        </div>
    </div>
</x-app-layout>
