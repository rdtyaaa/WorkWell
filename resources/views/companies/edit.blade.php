@extends('layouts.company')

@section('content')
    <!-- Main Content -->
    <div class="ml-64 p-4">
        <h1 class="text-2xl font-bold">Company Settings</h1>
        <div class="mt-4">
            <!-- Content for company settings -->
        <form action="{{ route('companies.update', $company) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ $company->name }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="company_description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="company_description" id="company_description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $company->description }}</textarea>
                </div>
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save
                    Settings</button>
            </form>
        </div>
    </div>
    </div>
@endsection
