<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::with('cutis')->get();
    
        // Proses cuti per tahun
        $cutiPerTahun = [];
        foreach ($pegawais as $pegawai) {
            $cutiPerTahun[$pegawai->id] = $pegawai->cutis->groupBy(function ($cuti) {
                return \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('Y');
            });
        }
    
        return view('cuti.index', compact('pegawais', 'cutiPerTahun'));
    }    
    
    public function show($id)
    {
        $pegawai = Pegawai::with('cutis')->findOrFail($id);

        $cutiPerTahun = $pegawai->cutis->groupBy(function ($cuti) {
            return \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('Y');
        });

        return view('cuti.show', compact('pegawai', 'cutiPerTahun'));
    }

    public function create()
    {
        $pegawais = Pegawai::all();
        return view('cuti.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'alasan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
    
        $pegawai = Pegawai::findOrFail($request->pegawai_id);
    
        // Hitung jumlah hari cuti yang diajukan
        $jumlah_hari = (new \DateTime($request->tanggal_mulai))->diff(new \DateTime($request->tanggal_selesai))->days + 1;
    
        // Ambil tahun dari tanggal_mulai cuti yang diajukan
        $tahun_cuti = date('Y', strtotime($request->tanggal_mulai));
    
        // Hitung total hari cuti dalam tahun yang sama dengan tanggal_mulai cuti yang diajukan
        $total_cuti_tahun_ini = Cuti::where('pegawai_id', $pegawai->id)
            ->whereYear('tanggal_mulai', $tahun_cuti) // Menggunakan tahun dari cuti yang diajukan
            ->selectRaw("SUM(DATEDIFF(tanggal_selesai, tanggal_mulai) + 1) as total_hari")
            ->value('total_hari') ?? 0; // Jika NULL, set ke 0
    
        if (($total_cuti_tahun_ini + $jumlah_hari) > 12) {
            return back()->withErrors('Maksimal cuti adalah 12 hari per tahun.');
        }
    
        // Validasi cuti hanya boleh 1 hari per bulan
        $bulan_mulai = date('Y-m', strtotime($request->tanggal_mulai));
    
        // Hitung total cuti dalam bulan yang sama
        $total_cuti_bulan_ini = Cuti::where('pegawai_id', $pegawai->id)
            ->whereRaw("DATE_FORMAT(tanggal_mulai, '%Y-%m') = ?", [$bulan_mulai])
            ->selectRaw("SUM(DATEDIFF(tanggal_selesai, tanggal_mulai) + 1) as total_hari")
            ->value('total_hari') ?? 0; // Jika NULL, set ke 0
    
        if (($total_cuti_bulan_ini + $jumlah_hari) > 1) {
            return back()->withErrors('Setiap pegawai hanya dapat menggunakan cuti maksimal 1 hari dalam bulan yang sama.');
        }
    
        // Simpan data cuti jika semua validasi terpenuhi
        Cuti::create([
            'pegawai_id' => $request->pegawai_id,
            'alasan' => $request->alasan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);
    
        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil ditambahkan!');
    }    

    public function edit($id)
    {
        $cuti = Cuti::findOrFail($id);
        $pegawais = Pegawai::all();
        return view('cuti.edit', compact('cuti', 'pegawais'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'alasan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
    
        $cuti = Cuti::findOrFail($id); 
        $pegawai = Pegawai::findOrFail($request->pegawai_id);
    
        // Hitung jumlah hari cuti yang diajukan
        $jumlah_hari = (new \DateTime($request->tanggal_mulai))->diff(new \DateTime($request->tanggal_selesai))->days + 1;
    
        // Ambil tahun dari tanggal_mulai cuti yang diajukan
        $tahun_cuti = date('Y', strtotime($request->tanggal_mulai));
    
        // Hitung total cuti dalam tahun yang sama, kecuali cuti yang sedang diedit
        $total_cuti_tahun_ini = Cuti::where('pegawai_id', $pegawai->id)
            ->whereYear('tanggal_mulai', $tahun_cuti)
            ->where('id', '!=', $cuti->id) // Hindari menghitung cuti yang sedang diedit
            ->selectRaw("SUM(DATEDIFF(tanggal_selesai, tanggal_mulai) + 1) as total_hari")
            ->value('total_hari') ?? 0; // Jika NULL, set ke 0
    
        if (($total_cuti_tahun_ini + $jumlah_hari) > 12) {
            return back()->withErrors('Maksimal cuti adalah 12 hari per tahun.');
        }
    
        // Validasi cuti hanya boleh 1 hari per bulan
        $bulan_mulai = date('Y-m', strtotime($request->tanggal_mulai));
    
        // Hitung total cuti dalam bulan yang sama, kecuali cuti yang sedang diedit
        $total_cuti_bulan_ini = Cuti::where('pegawai_id', $pegawai->id)
            ->whereRaw("DATE_FORMAT(tanggal_mulai, '%Y-%m') = ?", [$bulan_mulai])
            ->where('id', '!=', $cuti->id) // Hindari menghitung cuti yang sedang diedit
            ->selectRaw("SUM(DATEDIFF(tanggal_selesai, tanggal_mulai) + 1) as total_hari")
            ->value('total_hari') ?? 0; // Jika NULL, set ke 0
    
        if (($total_cuti_bulan_ini + $jumlah_hari) > 1) {
            return back()->withErrors('Setiap pegawai hanya dapat menggunakan cuti maksimal 1 hari dalam bulan yang sama.');
        }
    
        // Update data cuti jika semua validasi terpenuhi
        $cuti->update([
            'pegawai_id' => $request->pegawai_id,
            'alasan' => $request->alasan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);
    
        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil diperbarui!');
    }    

    public function destroy($id)
    {
        Cuti::destroy($id);
        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil dihapus!');
    }
}