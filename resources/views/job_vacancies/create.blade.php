@extends('layouts.company')

@section('content')
    <div class="mx-auto ml-64 bg-white p-4">
        <h1 class="mb-6 text-2xl font-semibold text-gray-800">Tambah Lowongan Pekerjaan</h1>

        <form action="{{ route('job_vacancies.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Posisi</label>
                <input type="text" name="position" id="position" value="{{ old('position') }}"
                    class="@error('position') border-red-500 @enderror mt-1 block w-full rounded-md border px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
                @error('position')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan</label>
                <textarea name="description" id="description"
                    class="@error('description') border-red-500 @enderror mt-1 block w-full rounded-md border px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="qualifications" class="block text-sm font-medium text-gray-700">Kualifikasi</label>
                <textarea name="qualifications" id="qualifications"
                    class="@error('qualifications') border-red-500 @enderror mt-1 block w-full rounded-md border px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>{{ old('qualifications') }}</textarea>
                @error('qualifications')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Gaji</label>
                <input type="number" name="salary" id="salary" value="{{ old('salary') }}"
                    class="@error('salary') border-red-500 @enderror mt-1 block w-full rounded-md border px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
                @error('salary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}"
                    class="@error('location') border-red-500 @enderror mt-1 block w-full rounded-md border px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">Tambah
                Lowongan</button>
        </form>

    </div>
@endsection
