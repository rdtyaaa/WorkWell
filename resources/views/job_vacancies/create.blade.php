@extends('layouts.company')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Lowongan Pekerjaan</h1>

        <form action="{{ route('job_vacancies.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Posisi</label>
                <input type="text" name="position" id="position" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan</label>
                <textarea name="description" id="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
            </div>

            <div class="mb-4">
                <label for="qualifications" class="block text-sm font-medium text-gray-700">Kualifikasi</label>
                <textarea name="qualifications" id="qualifications" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
            </div>

            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Gaji</label>
                <input type="number" name="salary" id="salary" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="location" id="location" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">Tambah Lowongan</button>
        </form>
    </div>
@endsection
