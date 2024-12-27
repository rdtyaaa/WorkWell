@extends('layouts.company')

@section('content')
    <div class="container mx-auto ml-64 max-w-6xl p-4">
        <h2 class="mb-6 text-2xl font-semibold text-gray-800">Kelola Pengguna</h2>

        <a href="{{ route('users.create') }}"
            class="mb-4 inline-block rounded bg-blue-500 px-4 py-2 text-sm text-white hover:bg-blue-700">Tambah Pengguna</a>

        @if (session('success'))
            <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg bg-white shadow-md">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Admin</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <!-- Toggle Switch -->
                                <label class="inline-flex cursor-pointer items-center">
                                    <input type="checkbox" value="" class="peer sr-only"
                                        data-user-id="{{ $user->id }}" {{ $user->role === 'admin' ? 'checked' : '' }}
                                        onchange="toggleAdmin(this)">
                                    <div
                                        class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-blue-800 rtl:peer-checked:after:-translate-x-full">
                                    </div>
                                </label>
                            </td>
                            <td class="flex gap-4 px-6 py-4 text-sm font-medium">
                                <a href="{{ route('users.edit', $user) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST">
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
    </div>

    <script>
        function toggleAdmin(element) {
            const userId = element.getAttribute('data-user-id');
            const isAdmin = element.checked;

            fetch(`/admin/users/${userId}/toggle-admin`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        isAdmin: isAdmin
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Refresh halaman untuk mendapatkan session baru
                    } else {
                        element.checked = !isAdmin; // Revert toggle jika gagal
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    element.checked = !isAdmin; // Revert toggle jika gagal
                });
        }
    </script>
@endsection
