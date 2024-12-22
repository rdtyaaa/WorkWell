<x-app-layout>
    <div class="container mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-2xl font-bold">Daftar Pengajuan Perusahaan</h1>
        <div class="relative overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 rtl:text-right">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr class="border-b bg-white">
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $company->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $company->address }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="{{ $company->status == 'approved'
                                        ? 'bg-green-500 text-white'
                                        : ($company->status == 'rejected'
                                            ? 'bg-red-500 text-white'
                                            : 'bg-yellow-500 text-white') }} rounded px-2 py-1 text-xs font-semibold">
                                    {{ ucfirst($company->status) }}
                                </span>
                                <a href="{{ route('companies.settings', $company) }}"
                                    class="rounded px-4 py-2 text-sm text-blue-500">
                                    Pengaturan
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
