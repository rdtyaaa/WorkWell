<x-app-layout>
    <div class="container mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-2xl font-bold">Kelola Pengajuan Perusahaan</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200 bg-white">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Nama</th>
                        <th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Alamat</th>
                        <th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr class="border">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $company->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $company->address }}</td>
                            <td class="flex gap-2 px-6 py-4">
                                <form method="POST" action="{{ route('admin.companies.updateStatus', $company) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit"
                                        class="rounded bg-green-500 px-4 py-2 text-sm font-bold text-white hover:bg-green-700 focus:outline-none">
                                        Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.companies.updateStatus', $company) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit"
                                        class="rounded bg-red-500 px-4 py-2 text-sm font-bold text-white hover:bg-red-700 focus:outline-none">
                                        Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
