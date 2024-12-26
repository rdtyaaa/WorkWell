<x-app-layout>
    <div class="container mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
        <h2 class="mb-4 text-xl font-semibold">Edit Data Diri</h2>

        <!-- Menampilkan error global jika ada -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('personal_data.update', $personalData->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="job_title" class="block text-gray-700">Jabatan Pekerjaan</label>
                <input type="text" name="job_title" id="job_title"
                    class="mt-2 w-full rounded-md border border-gray-300 p-2"
                    value="{{ old('job_title', $personalData->job_title) }}" required>

                <!-- Menampilkan error jika ada -->
                @error('job_title')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="company_name" class="block text-gray-700">Nama Perusahaan</label>
                <input type="text" name="company_name" id="company_name"
                    class="mt-2 w-full rounded-md border border-gray-300 p-2"
                    value="{{ old('company_name', $personalData->company_name) }}" required>

                <!-- Menampilkan error jika ada -->
                @error('company_name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700">Lokasi</label>
                <input type="text" name="location" id="location"
                    class="mt-2 w-full rounded-md border border-gray-300 p-2"
                    value="{{ old('location', $personalData->location) }}" required>

                <!-- Menampilkan error jika ada -->
                @error('location')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-gray-700">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date"
                    class="mt-2 w-full rounded-md border border-gray-300 p-2"
                    value="{{ old('start_date', $personalData->start_date->format('Y-m-d')) }}" required>

                <!-- Menampilkan error jika ada -->
                @error('start_date')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-gray-700">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date"
                    class="mt-2 w-full rounded-md border border-gray-300 p-2"
                    value="{{ old('end_date', $personalData->end_date->format('Y-m-d')) }}">

                <!-- Menampilkan error jika ada -->
                @error('end_date')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="is_working" class="block text-gray-700">Masih Bekerja?</label>
                <select name="is_working" id="is_working" class="mt-2 w-full rounded-md border border-gray-300 p-2"
                    required>
                    <option value="1" {{ old('is_working', $personalData->is_working) == 1 ? 'selected' : '' }}>Ya
                    </option>
                    <option value="0" {{ old('is_working', $personalData->is_working) == 0 ? 'selected' : '' }}>
                        Tidak</option>
                </select>

                <!-- Menampilkan error jika ada -->
                @error('is_working')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="mt-4 w-full rounded-md bg-blue-600 py-3 text-white">Simpan Data</button>
        </form>
    </div>
</x-app-layout>
