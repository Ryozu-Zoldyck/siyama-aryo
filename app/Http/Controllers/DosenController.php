<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::with('user')->get();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:dosen,nip',
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
        ]);

        // Buat user untuk dosen
        $user = User::create([
            'username' => $request->nip,
            'password' => Hash::make('password'),
            'role' => 'dosen'
        ]);

        // Buat data dosen
        Dosen::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|unique:dosen,nip,' . $id,
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        // Update username di user table
        if ($dosen->user) {
            $dosen->user->update([
                'username' => $request->nip
            ]);
        }

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diupdate!');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        
        // Hapus user terkait
        if ($dosen->user) {
            $dosen->user->delete();
        }
        
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus!');
    }
}
