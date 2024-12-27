<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobVacancy;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    public function dashboard()
    {
        // Ambil data lowongan pekerjaan dengan relasi ke perusahaan
        $jobs = JobVacancy::with('company')->get();

        // Kirim data ke view
        return view('dashboard', compact('jobs'));
    }

    // Menampilkan form untuk membuat lowongan pekerjaan
    public function create()
    {
        $user = Auth::user();
        $company = $user->company;
        return view('job_vacancies.create', compact('company'));
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
        $user = Auth::user();
        $company = $user->company;
        return view('job_vacancies.edit', compact('jobVacancy', 'company'));
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

    // JobVacancyController.php

    public function showApplicants(Request $request, JobVacancy $jobVacancy)
    {
        $user = Auth::user();
        $company = $user->company;

        $statusFilter = $request->input('status');

        $applications = Application::where('job_id', $jobVacancy->id);

        if ($statusFilter) {
            $applications = $applications->where('status', $statusFilter);
        }

        $applications = $applications->get();

        return view('job_vacancies.applicants', compact('jobVacancy', 'applications', 'company'));
    }
}
