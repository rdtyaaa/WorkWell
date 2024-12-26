@extends('layouts.company')

@section('content')
    <div class="ml-64 p-4 mx-auto bg-white">
        <h1 class="mb-6 text-2xl font-semibold text-gray-800">Edit Lowongan Pekerjaan</h1>

        <form action="{{ route('job_vacancies.update', $jobVacancy) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Posisi</label>
                <input type="text" name="position" id="position" value="{{ old('position', $jobVacancy->position) }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan</label>
                <textarea name="description" id="description"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>{{ old('description', $jobVacancy->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="qualifications" class="block text-sm font-medium text-gray-700">Kualifikasi</label>
                <textarea name="qualifications" id="qualifications"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>{{ old('qualifications', $jobVacancy->qualifications) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Gaji</label>
                <input type="number" name="salary" id="salary" value="{{ old('salary', $jobVacancy->salary) }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="location" id="location" value="{{ old('location', $jobVacancy->location) }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
            </div>

            <button type="submit"
                class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">Perbarui
                Lowongan</button>
        </form>
    </div>
@endsection
