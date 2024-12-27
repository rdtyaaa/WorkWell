<x-app-layout>
    <div class="container mx-auto max-w-7xl py-12">
        <h2 class="mb-6 text-2xl font-semibold text-gray-800">Daftar Lamaran</h2>

        @if ($applications->isEmpty())
            <p class="text-gray-600">Anda belum mengajukan lamaran pekerjaan.</p>
        @else
            <div class="overflow-x-auto rounded-lg bg-white shadow-md">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">
                                Posisi</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">
                                Perusahaan</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">
                                Lokasi</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">
                                Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">
                                Diajukan Pada</th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-gray-500">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $application->job->position }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $application->job->company->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $application->job->location }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="{{ $application->status == 'diterima' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} rounded-lg px-2 py-1 text-sm font-medium">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $application->created_at->format('d M Y') }}</td>
                                <td class="flex gap-4 px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('applications.show', $application->id) }}"
                                        class="text-green-600 hover:text-green-800">
                                        Lihat
                                    </a>
                                    <a href="{{ route('applications.edit', $application->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <button data-modal-target="delete-modal-{{ $application->id }}"
                                        data-modal-toggle="delete-modal-{{ $application->id }}"
                                        class="text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal untuk Hapus -->
                            <div id="delete-modal-{{ $application->id }}" tabindex="-1"
                                class="fixed inset-0 z-50 hidden h-screen max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden">
                                <div class="absolute inset-0 bg-black opacity-25"></div>
                                <div class="relative max-h-full w-full max-w-md p-4">
                                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="delete-modal-{{ $application->id }}">
                                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-medium text-gray-500">Apakah Anda yakin ingin
                                                menghapus lamaran ini?</h3>
                                            <form action="{{ route('applications.destroy', $application->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-sm text-white hover:bg-red-800">
                                                    Ya, Hapus
                                                </button>
                                            </form>
                                            <button data-modal-hide="delete-modal-{{ $application->id }}"
                                                type="button"
                                                class="mt-4 inline-flex items-center rounded-lg bg-gray-100 px-5 py-2.5 text-sm text-gray-900 hover:bg-gray-200">
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
</x-app-layout>
