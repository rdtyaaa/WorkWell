@extends('layouts.company')

@section('content')
    <div class="ml-64 p-4">
        <h2 class="mb-6 text-2xl font-semibold text-gray-800">Daftar Pelamar untuk {{ $jobVacancy->position }}</h2>

        <!-- Filter berdasarkan status -->
        <div class="mb-4 flex items-center">
            <form action="{{ route('job_vacancies.show_applicants', $jobVacancy->id) }}" method="GET" class="flex gap-2">
                <select name="status" id="status" class="rounded-md border border-gray-300 px-4 py-2">
                    <option value="">Semua Status</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                </select>
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white">Filter</button>
            </form>
        </div>

        @if ($applications->isEmpty())
            <p class="text-gray-600">Tidak ada pelamar untuk lowongan ini.</p>
        @else
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">Nama
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">Email
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">
                                Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $application->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $application->user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <span
                                        class="{{ $application->status == 'diterima' ? 'bg-green-100 text-green-700' : ($application->status == 'ditolak' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }} rounded-lg px-2 py-1 text-sm font-medium">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('applications.show', $application->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                                    <form action="{{ route('applications.updateStatus', $application->id) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="status" value="diterima"
                                            class="ml-2 text-green-600 hover:text-green-800">Approve</button>
                                        <button type="submit" name="status" value="ditolak"
                                            class="ml-2 text-red-600 hover:text-red-800">Reject</button>
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
