@extends('layouts.company')

@section('content')
    <div class="ml-64 p-4">
        <h1 class="mb-6 text-2xl font-semibold text-gray-800">Daftar Lowongan Pekerjaan</h1>

        <!-- Tombol Create -->
        <div class="mb-4">
            <a href="{{ route('job_vacancies.create') }}"
                class="inline-block rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Buat Lowongan Pekerjaan
            </a>
        </div>

        @if ($jobVacancies->isEmpty())
            <p>Belum ada lowongan pekerjaan yang tersedia.</p>
        @else
            <div class="mb-6 overflow-hidden rounded-lg bg-white shadow">
                <table class="min-w-full bg-white">

                    <thead>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">Posisi
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">Gaji
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">
                                Lokasi
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobVacancies as $jobVacancy)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $jobVacancy->position }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $jobVacancy->salary }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $jobVacancy->location }}</td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('job_vacancies.edit', $jobVacancy) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <button data-modal-target="delete-modal-{{ $jobVacancy->id }}"
                                        data-modal-toggle="delete-modal-{{ $jobVacancy->id }}"
                                        class="text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            <div id="delete-modal-{{ $jobVacancy->id }}" tabindex="-1"
                                class="fixed left-0 right-0 top-0 z-50 hidden h-screen max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                                <div class="absolute inset-0 bg-black opacity-25"></div>
                                <div class="relative max-h-full w-full max-w-md p-4">
                                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                        <!-- Tombol Close -->
                                        <button type="button"
                                            class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="delete-modal-{{ $jobVacancy->id }}">
                                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>

                                        <!-- Konten Modal -->
                                        <div class="p-4 text-center md:p-5">
                                            <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah
                                                Anda yakin ingin menghapus lowongan ini?</h3>

                                            <!-- Form untuk menghapus -->
                                            <form action="{{ route('job_vacancies.destroy', $jobVacancy) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
                                                    Ya, Hapus
                                                </button>
                                            </form>

                                            <button data-modal-hide="delete-modal-{{ $jobVacancy->id }}" type="button"
                                                class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
