<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuatLaporan;
use Illuminate\Support\Facades\Auth;

class BuatLaporanController extends Controller
{
    public function form()
    {
        return view('buatlaporan');
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'notelp' => 'required|string|max:50',
            'date' => 'required|date',
            'time' => 'required',
            'polres' => 'required|string|max:100',
            'alamat' => 'required|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240',
            'deskripsi' => 'required|string',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('uploads', 'public');
        }

        BuatLaporan::create([
            'user_id' => Auth::id(),                 
            'nama' => Auth::user()->name,            
            'email' => Auth::user()->email,         
            'notelp' => $validated['notelp'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'polres' => $validated['polres'],
            'alamat' => $validated['alamat'],
            'foto' => $path,
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('laporansaya')
                         ->with('success', 'Laporan berhasil dikirim.');
    }

    public function index()
{
    $buatlaporan = BuatLaporan::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('laporansaya', compact('buatlaporan'));
}

}
