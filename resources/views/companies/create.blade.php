<x-app-layout>
    <div class="container mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-2xl font-bold">Daftarkan Perusahaan Anda</h1>
        <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data"
            class="mb-4 rounded bg-white px-8 pb-8 pt-6 shadow-md">
            @csrf
            <div class="mb-4">
                <label class="text-medium mb-2 block font-bold text-gray-700" for="file_input">Logo
                    Perusahaan</label>
                <input
                    class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
                    aria-describedby="file_input_help" id="file_input" type="file" name="logo" id="logo">
                <p class="mt-1 text-sm text-gray-500" id="file_input_help">SVG, PNG, JPG or GIF (MAX.
                    800x400px).</p>
            </div>

            <div class="mb-4">
                <label for="name" class="mb-2 block text-sm font-bold text-gray-700">Nama Perusahaan</label>
                <input type="text" name="name" id="name"
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    required>
            </div>
            <div class="mb-4">
                <label for="address" class="mb-2 block text-sm font-bold text-gray-700">Alamat</label>
                <textarea name="address" id="address" rows="4"
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    required></textarea>
            </div>
            <div class="mb-4">
                <label for="description" class="mb-2 block text-sm font-bold text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="focus:shadow-outline rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none">
                    Ajukan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
