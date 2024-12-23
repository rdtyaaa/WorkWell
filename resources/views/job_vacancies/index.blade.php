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
                                    <form action="{{ route('job_vacancies.destroy', $jobVacancy) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
