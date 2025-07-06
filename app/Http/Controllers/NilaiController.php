<?php
namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with(['mahasiswa', 'dosen'])->get();
        return view('nilai.index', compact('nilai'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        return view('nilai.create', compact('mahasiswa', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'dosen_id' => 'required|exists:dosen,id',
            'mata_kuliah' => 'required|string|max:255',
            'semester' => 'required|string|max:10',
            'nilai_tugas' => 'required|integer|min:0|max:100',
            'nilai_uts' => 'required|integer|min:0|max:100',
            'nilai_uas' => 'required|integer|min:0|max:100',
        ]);

        // Hitung nilai akhir (30% tugas + 30% UTS + 40% UAS)
        $nilai_akhir = ($request->nilai_tugas * 0.3) + ($request->nilai_uts * 0.3) + ($request->nilai_uas * 0.4);
        
        // Tentukan grade berdasarkan nilai akhir
        $grade = $this->hitungGrade($nilai_akhir);

        Nilai::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'dosen_id' => $request->dosen_id,
            'mata_kuliah' => $request->mata_kuliah,
            'semester' => $request->semester,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
            'nilai_akhir' => round($nilai_akhir, 2),
            'grade' => $grade,
        ]);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        return view('nilai.edit', compact('nilai', 'mahasiswa', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'dosen_id' => 'required|exists:dosen,id',
            'mata_kuliah' => 'required|string|max:255',
            'semester' => 'required|string|max:10',
            'nilai_tugas' => 'required|integer|min:0|max:100',
            'nilai_uts' => 'required|integer|min:0|max:100',
            'nilai_uas' => 'required|integer|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);

        // Hitung nilai akhir (30% tugas + 30% UTS + 40% UAS)
        $nilai_akhir = ($request->nilai_tugas * 0.3) + ($request->nilai_uts * 0.3) + ($request->nilai_uas * 0.4);
        
        // Tentukan grade berdasarkan nilai akhir
        $grade = $this->hitungGrade($nilai_akhir);

        $nilai->update([
            'mahasiswa_id' => $request->mahasiswa_id,
            'dosen_id' => $request->dosen_id,
            'mata_kuliah' => $request->mata_kuliah,
            'semester' => $request->semester,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
            'nilai_akhir' => round($nilai_akhir, 2),
            'grade' => $grade,
        ]);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diupdate!');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus!');
    }

    public function cekNilaiMahasiswa()
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan!');
        }

        $nilai = Nilai::where('mahasiswa_id', $mahasiswa->id)
                     ->with(['dosen'])
                     ->get();

        return view('nilai.cek', compact('nilai'));
    }

    public function cekNilaiAdmin(Request $request)
    {
        $mahasiswaList = \App\Models\Mahasiswa::all();
        $selectedMahasiswa = null;
        $nilai = collect();
        if ($request->mahasiswa_id) {
            $selectedMahasiswa = \App\Models\Mahasiswa::find($request->mahasiswa_id);
            if ($selectedMahasiswa) {
                $nilai = \App\Models\Nilai::where('mahasiswa_id', $selectedMahasiswa->id)->with('dosen')->get();
            }
        }
        return view('nilai.cek_admin', compact('mahasiswaList', 'selectedMahasiswa', 'nilai'));
    }

    private function hitungGrade($nilai_akhir)
    {
        if ($nilai_akhir >= 85) {
            return 'A';
        } elseif ($nilai_akhir >= 75) {
            return 'B';
        } elseif ($nilai_akhir >= 65) {
            return 'C';
        } elseif ($nilai_akhir >= 50) {
            return 'D';
        } else {
            return 'E';
        }
    }
}
