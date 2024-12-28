<x-app-layout>

    <div class="flex h-20 items-center overflow-x-hidden bg-sky-600 object-cover">
        <form class="mx-auto flex items-center gap-8" method="GET" action="{{ route('recomendation') }}">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative flex w-full items-center gap-4">
                <label class="mb-2 text-white" for="job-search">Kerja Apa?</label>
                <input type="text" name="job-search" id="job-search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Programmer" value="{{ request('job-search') }}" />
            </div>
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative flex w-full items-center gap-4">
                <label class="mb-2 text-white" for="location-search">Dimana?</label>
                <input type="text" name="location-search" id="location-search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Jakarta" value="{{ request('location-search') }}" />
            </div>
            <button type="submit"
                class="h-fit rounded-lg border border-fuchsia-700 bg-fuchsia-700 px-6 py-2.5 text-sm font-medium text-white hover:bg-fuchsia-800 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 dark:bg-fuchsia-600 dark:hover:bg-fuchsia-700 dark:focus:ring-fuchsia-800">
                Search
            </button>
        </form>
    </div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mt-4 flex flex-wrap gap-4">
                @if ($message)
                    <p class="w-full rounded bg-sky-600 p-4 text-center text-sm text-white">{{ $message }}</p>
                @else
                    <div class="mt-4 flex flex-wrap gap-4" id="job-list-container">
                        @foreach ($jobs as $job)
                            <x-card :logo="$job->company->logo" :companyName="$job->company->name" :position="$job->position" :salary="$job->salary"
                                :description="$job->company->name" :location="$job->location" :jobId="$job->id" />
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Main modal -->
            <div id="static-modal"
                class="fixed left-0 right-0 top-0 z-50 flex hidden h-full w-full items-center justify-center bg-black bg-opacity-50">
                <div class="max-h-6xl relative max-w-7xl rounded-lg bg-white shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600">
                        <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                            Job Position
                        </h3>
                        <button data-modal-hide type="button"
                            class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            ✕
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div>
                        <div class="bg-sky-600">
                            <img class="mx-auto h-36 p-8" id="modal-company-logo" alt="Company logo" />
                        </div>
                    </div>
                    <div class="space-y-2 p-4">
                        <p id="modal-qualifications" class="text-base text-gray-500 dark:text-gray-400"></p>
                        <p id="modal-salary" class="text-base font-semibold text-sky-600 dark:text-white"></p>
                        <p id="modal-location" class="text-base text-gray-500 dark:text-gray-400"></p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center space-x-4 border-t p-4 dark:border-gray-600">
                        <a id="apply-now-btn" href="#"
                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-white hover:bg-blue-800">Apply Now</a>
                        <button data-modal-hide type="button"
                            class="rounded-lg bg-gray-200 px-5 py-2.5 text-gray-900 hover:bg-gray-300">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function openModal(element) {
            const jobId = element.getAttribute('data-id');

            fetch(`/job-vacancies/${jobId}`)
                .then(response => response.json())
                .then(job => {
                    // Isi data di modal
                    document.getElementById('modal-title').innerText = job.position;
                    document.getElementById('modal-qualifications').innerText = job.qualifications;
                    document.getElementById('modal-salary').innerText = `Rp ${job.salary.toLocaleString('id-ID')}`;
                    document.getElementById('modal-location').innerText = job.location;
                    document.getElementById('modal-company-logo').src = `{{ asset('storage/') }}/${job.company.logo}`;
                    document.getElementById('modal-company-logo').alt = `${job.company.name} logo`;

                    // Perbarui tombol "Apply Now"
                    const applyNowBtn = document.getElementById('apply-now-btn');
                    applyNowBtn.href = `/jobs/${jobId}/apply`;

                    // Tampilkan modal
                    const modal = document.getElementById('static-modal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                })
                .catch(error => {
                    console.error('Error fetching job details:', error);
                });
        }

        // Close modal function
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.getElementById('static-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        });
    </script>
</x-app-layout>
