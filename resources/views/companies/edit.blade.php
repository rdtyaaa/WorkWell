@extends('layouts.company')

@section('content')
    <!-- Main Content -->
    <div class="ml-64 p-4">
        <div class="w-full">
            <h1 class="text-2xl font-bold">Company Settings</h1>
            @if ($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" class="mt-2 h-24 mx-auto">
            @endif
        </div>
        <div class="mt-4">
            @if ($errors->any())
                <div class="mb-4 rounded border border-red-400 bg-red-200 p-4 text-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="mb-4 rounded border border-green-400 bg-green-100 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="logo" class="block text-sm font-medium text-gray-700">Company Logo</label>
                    <input type="file" name="logo" id="logo"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="name" id="name" value="{{ $company->name }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ $company->address }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $company->description }}</textarea>
                </div>

                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save
                    Settings</button>
            </form>

            <!-- Delete Button Form -->
            <form action="{{ route('companies.destroy', $company) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700">Delete
                    Company</button>
            </form>
        </div>
    </div>
@endsection
