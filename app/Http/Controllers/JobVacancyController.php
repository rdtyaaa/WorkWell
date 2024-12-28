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
        $jobs = JobVacancy::with('company')->inRandomOrder()->limit(8)->get();

        return view('dashboard', compact('jobs'));
    }

    public function recomendation(Request $request)
    {
        $jobs = JobVacancy::with('company')
            ->when($request->has('job-search'), function ($query) use ($request) {
                $query->where('position', 'like', '%' . $request->input('job-search') . '%');
            })
            ->when($request->has('location-search'), function ($query) use ($request) {
                $query->where('location', 'like', '%' . $request->input('location-search') . '%');
            })
            ->inRandomOrder()
            ->limit(30)
            ->get();

        if ($jobs->isEmpty()) {
            $message = 'Tidak ada pekerjaan yang ditemukan.';
        } else {
            $message = null;
        }

        return view('recomendation', compact('jobs', 'message'));
    }

    public function create()
    {
        $user = Auth::user();
        $company = $user->company;
        return view('job_vacancies.create', compact('company'));
    }

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
        $company = $user->company;

        JobVacancy::create([
            'position' => $request->position,
            'description' => $request->description,
            'qualifications' => $request->qualifications,
            'salary' => $request->salary,
            'location' => $request->location,
            'company_id' => $company->id,
        ]);

        return redirect()->route('job_vacancies.index')->with('success', 'Lowongan pekerjaan berhasil ditambahkan!');
    }

    public function index()
    {
        $user = Auth::user();
        $company = $user->company;
        $jobVacancies = $company ? $company->jobVacancies : [];

        return view('job_vacancies.index', compact('jobVacancies', 'company'));
    }

    public function edit(JobVacancy $jobVacancy)
    {
        $user = Auth::user();
        $company = $user->company;
        return view('job_vacancies.edit', compact('jobVacancy', 'company'));
    }

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

    public function destroy(JobVacancy $jobVacancy)
    {
        $jobVacancy->delete();
        return redirect()->route('job_vacancies.index')->with('success', 'Lowongan pekerjaan berhasil dihapus!');
    }

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

    public function show($id)
    {
        $job = JobVacancy::with('company')->findOrFail($id);
        return response()->json($job);
    }
}
