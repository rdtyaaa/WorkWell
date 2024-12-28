<div
    class="flex h-[32rem] w-full max-w-64 flex-col rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
    <a href="#">
        <img class="rounded-t-lg bg-sky-600 p-8" src="{{ asset('storage/' . $logo) }}" alt="{{ $companyName }} logo" />
    </a>
    <div class="flex flex-grow flex-col px-5 pb-5">
        <p class="mt-2 text-lg font-bold text-sky-600">Rp {{ number_format($salary, 0, ',', '.') }}</p>
        <p class="mt-2 text-sm text-gray-500">{{ $description }}</p>

        <!-- Div ini akan mengatur lokasi dan tombol ke bawah -->
        <div class="mt-auto flex flex-col space-y-2">
            <h5 class="mt-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                {{ $position }}</h5>
            <span class="text-gray-600 dark:text-white">{{ $location }}</span>
            <a href="javascript:void(0)" data-id="{{ $jobId }}" onclick="openModal(this)"
                class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800">
                Lihat Detail
            </a>
        </div>
    </div>
</div>
