<div class="w-full max-w-sm rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
    <a href="#">
        <img class="rounded-t-lg p-8" src="{{ asset('storage/' . $logo) }}" alt="{{ $companyName }} logo" />
    </a>
    <div class="px-5 pb-5">
        <a href="#">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $position }}</h5>
        </a>
        <p class="mt-2 text-sm text-gray-500">{{ $description }}</p>
        <p class="mt-2 text-sm text-gray-500">Rp {{ number_format($salary, 0, ',', '.') }}</p>
        <div class="mt-4 flex items-center justify-between">
            <span class="text-lg font-medium text-gray-900 dark:text-white">{{ $location }}</span>
            <a href="#"
                class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Apply Now
            </a>
        </div>
    </div>
</div>
