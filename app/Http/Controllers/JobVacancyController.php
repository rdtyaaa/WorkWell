<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    // Menampilkan form untuk membuat lowongan pekerjaan
    public function create()
    {
        return view('job_vacancies.create');
    }

    // Menyimpan lowongan pekerjaan baru
    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'salary' => 'required|numeric',
            'location' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $company = $user->company; // Asumsi bahwa user sudah memiliki perusahaan yang terdaftar

        JobVacancy::create([
            'position' => $request->position,
            'description' => $request->description,
            'qualifications' => $request->qualifications,
            'salary' => $request->salary,
            'location' => $request->location,
            'company_id' => $company->id, // Mengaitkan lowongan dengan perusahaan yang dimiliki user
        ]);

        return redirect()->route('job_vacancies.index')->with('success', 'Lowongan pekerjaan berhasil ditambahkan!');
    }

    // Menampilkan daftar lowongan pekerjaan
    public function index()
    {
        $user = Auth::user();
        $company = $user->company;
        $jobVacancies = $company ? $company->jobVacancies : [];

        return view('job_vacancies.index', compact('jobVacancies', 'company'));
    }

    // Menampilkan form untuk mengedit lowongan pekerjaan
    public function edit(JobVacancy $jobVacancy)
    {
        return view('job_vacancies.edit', compact('jobVacancy'));
    }

    // Memperbarui lowongan pekerjaan
    public function update(Request $request, JobVacancy $jobVacancy)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'salary' => 'required|numeric',
            'location' => 'required|string|max:255',
        ]);

        $jobVacancy->update([
            'position' => $request->position,
            'description' => $request->description,
            'qualifications' => $request->qualifications,
            'salary' => $request->salary,
            'location' => $request->location,
        ]);

        return redirect()->route('job_vacancies.index')->with('success', 'Lowongan pekerjaan berhasil diperbarui!');
    }

    // Menghapus lowongan pekerjaan
    public function destroy(JobVacancy $jobVacancy)
    {
        $jobVacancy->delete();
        return redirect()->route('job_vacancies.index')->with('success', 'Lowongan pekerjaan berhasil dihapus!');
    }
}
