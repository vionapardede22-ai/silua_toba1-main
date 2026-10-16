<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit() {
        // Ambil data pertama, jika tidak ada buat baru kosong
        $profile = CompanyProfile::first() ?? new CompanyProfile();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request) {
    $request->validate([
        'hero_title'   => 'required|string|max:255', // Pastikan divalidasi
        'history_text' => 'required',
        'vision'       => 'required',
        'mission'      => 'required',
        'map_embed'    => 'required',
    ]);

    // Simpan atau Update data ID nomor 1
    \App\Models\CompanyProfile::updateOrCreate(
        ['id' => 1],
        $request->all() // Semua data dari form akan masuk jika sudah ada di $fillable
    );

    return back()->with('success', 'Info Profil Berhasil Diperbarui!');
}

}