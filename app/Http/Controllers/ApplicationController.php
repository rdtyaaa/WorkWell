<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\Application;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        // Ambil semua lamaran pengguna saat ini
        $applications = Application::with('job') // Relasi ke model JobVacancy
            ->where('user_id', auth()->id())
            ->get();

        return view('applications.index', compact('applications'));
    }

    public function create($jobId)
    {
        // Fetch job details with company relationship
        $job = JobVacancy::with('company')->findOrFail($jobId);

        return view('applications.apply', compact('job'));
    }

    public function store(Request $request, $jobId)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
            'supporting_documents' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan file CV
        $cvPath = $request->file('cv')->store('applications/cv', 'public');

        // Simpan dokumen pendukung jika ada
        $supportingDocPath = $request->file('supporting_documents') ? $request->file('supporting_documents')->store('applications/supporting_docs', 'public') : null;

        // Buat aplikasi
        Application::create([
            'user_id' => Auth::id(),
            'job_id' => $jobId,
            'cv' => $cvPath,
            'supporting_documents' => $supportingDocPath,
        ]);

        return redirect()->route('applications.index')->with('success', 'Lamaran berhasil dikirim.');
    }

    public function edit($id)
    {
        $application = Application::with('job.company')->findOrFail($id);

        // Pastikan hanya user yang mengajukan lamaran yang bisa mengedit
        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $job = $application->job; // JobVacancy terkait
        $company = $job->company; // Perusahaan terkait

        return view('applications.edit', compact('application', 'job', 'company'));
    }

    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        // Pastikan hanya user yang mengajukan lamaran yang bisa mengupdate
        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'supporting_documents' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan file CV jika ada
        if ($request->hasFile('cv')) {
            // Menggunakan disk 'public' untuk menyimpan file
            $cvPath = $request->file('cv')->store('applications/cv', 'public');
            $application->cv = $cvPath;
        }

        // Simpan dokumen pendukung jika ada
        if ($request->hasFile('supporting_documents')) {
            // Menggunakan disk 'public' untuk menyimpan file
            $supportingDocPath = $request->file('supporting_documents')->store('applications/supporting_docs', 'public');
            $application->supporting_documents = $supportingDocPath;
        }

        // Menyimpan perubahan data aplikasi
        $application->save();

        return redirect()->route('applications.index')->with('success', 'Lamaran berhasil diperbarui.');
    }

    public function show($id)
    {
        // Memuat data Application dan PersonalData terkait user-nya
        $application = Application::with('user.personal')->findOrFail($id);

        return view('applications.show', compact('application'));
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);

        // Pastikan hanya user yang mengajukan lamaran yang bisa menghapus
        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Lamaran berhasil dihapus.');
    }


    public function updateStatus(Request $request, Application $application)
    {
        // Update status pelamar
        $validated = $request->validate([
            'status' => 'required|in:diterima,ditolak,proses',
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('job_vacancies.show_applicants', $application->job_id)
                         ->with('success', 'Status aplikasi berhasil diperbarui');
    }
}
