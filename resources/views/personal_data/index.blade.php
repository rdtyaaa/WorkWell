<x-app-layout>
    <div class="container mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
        <h2 class="mb-6 text-2xl font-semibold text-gray-800">Pengalaman</h2>
        <a href="{{ route('personal_data.create') }}"
            class="mb-4 inline-block rounded-lg bg-blue-600 px-6 py-3 text-white shadow-md transition duration-300 hover:bg-blue-700">
            Tambah Data
        </a>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($data as $item)
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $item->job_title }}</h3>
                    <p class="mt-2 text-gray-600">{{ $item->company_name }}</p>
                    <p class="text-gray-600">{{ $item->location }}</p>
                    <p class="mt-2 text-gray-600">
                        Mulai: {{ \Carbon\Carbon::parse($item->start_date)->format('F Y') }}
                    </p>
                    <p class="mt-2 text-gray-600">
                        Selesai: {{ \Carbon\Carbon::parse($item->end_date)->format('F Y') }}
                    </p>
                    <p class="mt-2 text-gray-600">
                        Status: {{ $item->is_working ? 'Masih Bekerja' : 'Tidak Bekerja' }}
                    </p>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('personal_data.edit', $item->id) }}"
                            class="text-blue-500 transition duration-300 hover:text-blue-700">Edit</a>
                        <form action="{{ route('personal_data.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-500 transition duration-300 hover:text-red-700">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
