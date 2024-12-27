<x-app-layout>
    <div class="container mx-auto max-w-7xl py-12">
        <h2 class="mb-6 text-2xl font-semibold text-gray-800">Detail Lamaran</h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Kartu Detail Lamaran (Kiri) -->
            <div class="rounded-lg bg-white p-6 shadow-md">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Informasi Lamaran</h3>
                <div class="space-y-4">
                    <p class="text-gray-600"><strong>Posisi:</strong> {{ $application->job->position }}</p>
                    <p class="text-gray-600"><strong>Perusahaan:</strong> {{ $application->job->company->name }}</p>
                    <p class="text-gray-600"><strong>Lokasi:</strong> {{ $application->job->location }}</p>
                    <p class="text-gray-600"><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
                    <p class="text-gray-600"><strong>Diajukan Pada:</strong>
                        {{ $application->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Kartu Detail User (Kanan) -->
            <div class="rounded-lg bg-white p-6 shadow-md">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Informasi Pelamar</h3>
                <div class="space-y-4">
                    <p class="text-gray-600"><strong>Nama Pengguna:</strong> {{ $application->user->name }}</p>
                    <p class="text-gray-600"><strong>Email:</strong> {{ $application->user->email }}</p>
                </div>
            </div>
        </div>

        <div class="mt-12 rounded-lg bg-white p-6 shadow-md">
            <div>
                <!-- Jika ada data pengalaman kerja -->
                @if ($application->user->personal->isNotEmpty())
                    <h3 class="text-xl font-semibold text-gray-800">Pengalaman Kerja</h3>
                    <!-- Menampilkan data pengalaman kerja dalam bentuk tabel yang rapi -->
                    <div class="mt-4 overflow-hidden bg-white shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Job Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Perusahaan
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Lokasi
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Periode
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($application->user->personal as $data)
                                    <tr>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $data->job_title }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $data->company_name }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $data->location }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            {{ $data->start_date->format('d M Y') }} -
                                            @if ($data->is_working)
                                                <span class="text-green-500">Sekarang</span>
                                            @else
                                                {{ $data->end_date->format('d M Y') }}
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                            @if ($data->is_working)
                                                <span class="text-green-500">Sedang Bekerja</span>
                                            @else
                                                <span class="text-red-500">Tidak Bekerja</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">Belum ada pengalaman kerja yang ditambahkan.</p>
                @endif
            </div>

            <h3 class="my-6 text-xl font-semibold text-gray-800">Dokumen Lamaran</h3>
            <div class="flex flex-wrap gap-4">
                <!-- Lihat Dokumen -->
                @if ($application->cv)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $application->cv) }}" target="_blank"
                            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                            Lihat CV
                        </a>
                    </div>
                @endif

                @if ($application->supporting_documents)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $application->supporting_documents) }}" target="_blank"
                            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                            Lihat Dokumen Pendukung
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
