<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    // Form untuk mendaftarkan perusahaan
    public function create()
    {
        return view('companies.create');
    }

    // Proses pendaftaran perusahaan
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'description' => 'nullable|string|max:1000',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi logo
        ]);

        $user = Auth::user();

        // Menyimpan logo ke storage dan mendapatkan path-nya
        $logoPath = $request->file('logo')->store('company_logos', 'public');

        // Menggunakan Company::create untuk menyimpan data perusahaan
        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'user_id' => $user->id, // Menyertakan user_id
            'logo' => $logoPath, // Menyimpan path logo
        ]);

        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil didaftarkan!');
    }

    // Daftar perusahaan yang diajukan user
    public function index()
    {
        $companies = Company::where('user_id', Auth::id())->get();
        return view('companies.index', compact('companies'));
    }

    // Admin: Kelola pengajuan perusahaan
    public function adminIndex()
    {
        $companies = Company::where('status', 'pending')->get();
        return view('admin.companies.index', compact('companies'));
    }

    // Admin: Persetujuan atau penolakan perusahaan
    public function updateStatus(Request $request, Company $company)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $company->update(['status' => $request->status]);

        return redirect()->route('admin.companies.index')->with('success', 'Status perusahaan berhasil diperbarui.');
    }
}
