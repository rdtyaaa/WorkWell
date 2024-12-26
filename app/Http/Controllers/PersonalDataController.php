<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PersonalDataController extends Controller
{
    public function index()
    {
        $data = PersonalData::where('user_id', Auth::id())->get();
        return view('personal_data.index', compact('data'));
    }

    public function create()
    {
        return view('personal_data.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_working' => 'required|boolean',
        ]);

        PersonalData::create([
            'user_id' => Auth::id(),
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_working' => $request->is_working,
        ]);

        return redirect()->route('personal_data.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $personalData = PersonalData::findOrFail($id);
        return view('personal_data.edit', compact('personalData'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_working' => 'required|boolean',
        ]);

        // Cari PersonalData berdasarkan ID
        $personalData = PersonalData::find($id);

        if (!$personalData) {
            return redirect()->route('personal_data.index')->with('error', 'Data tidak ditemukan.');
        }

        try {
            // Update data
            $personalData->update([
                'job_title' => $request->job_title,
                'company_name' => $request->company_name,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_working' => $request->is_working,
            ]);

            return redirect()->route('personal_data.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            // Tangkap error dan kirimkan error ke log
            \Log::error('Update failed: ' . $e->getMessage());

            return redirect()->route('personal_data.index')->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy($id)
    {
        $personalData = PersonalData::findOrFail($id);
        $personalData->delete();
        return redirect()->route('personal_data.index')->with('success', 'Data berhasil dihapus!');
    }
}
