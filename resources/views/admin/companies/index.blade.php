@extends('layouts.company')

@section('content')
    <div class="container mx-auto ml-64 max-w-6xl p-4">
        <h1 class="mb-6 text-2xl font-semibold text-gray-800">Kelola Pengajuan Perusahaan</h1>
        <div class="overflow-x-auto rounded-lg bg-white shadow-md">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="border-b">
                        <th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Nama</th>
                        <th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Alamat</th>
                        <th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Pendaftar</th>
                        <th class="border px-6 py-3 text-left text-sm font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $company->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $company->address }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $company->user->name }}</td>
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
@endsection
