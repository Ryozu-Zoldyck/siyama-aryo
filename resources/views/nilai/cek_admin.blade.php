@extends('layouts.app')

@section('title', 'Cek Nilai Mahasiswa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-search me-2"></i>Cek Nilai Mahasiswa
                    </h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('nilai.cek.admin') }}" class="mb-4 row g-3 align-items-end">
                        <div class="col-md-8">
                            <label for="mahasiswa_id" class="form-label">Pilih Mahasiswa</label>
                            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach($mahasiswaList as $mhs)
                                    <option value="{{ $mhs->id }}" {{ request('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                                        {{ $mhs->nim }} - {{ $mhs->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>Cek Nilai
                            </button>
                        </div>
                    </form>

                    @if($selectedMahasiswa)
                        <div class="mb-4">
                            <h5>Data Mahasiswa</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>NIM:</strong> {{ $selectedMahasiswa->nim }}</li>
                                <li class="list-group-item"><strong>Nama:</strong> {{ $selectedMahasiswa->nama }}</li>
                                <li class="list-group-item"><strong>Jurusan:</strong> {{ $selectedMahasiswa->jurusan }}</li>
                                <li class="list-group-item"><strong>Semester:</strong> {{ $selectedMahasiswa->semester }}</li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Nilai Tugas</th>
                                        <th>Nilai UTS</th>
                                        <th>Nilai UAS</th>
                                        <th>Nilai Akhir</th>
                                        <th>Grade</th>
                                        <th>Dosen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($nilai as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->mata_kuliah }}</td>
                                        <td>{{ $item->semester }}</td>
                                        <td>{{ $item->nilai_tugas }}</td>
                                        <td>{{ $item->nilai_uts }}</td>
                                        <td>{{ $item->nilai_uas }}</td>
                                        <td><strong>{{ $item->nilai_akhir }}</strong></td>
                                        <td>
                                            @if($item->grade == 'A')
                                                <span class="badge badge-success">{{ $item->grade }}</span>
                                            @elseif($item->grade == 'B')
                                                <span class="badge badge-info">{{ $item->grade }}</span>
                                            @elseif($item->grade == 'C')
                                                <span class="badge badge-warning">{{ $item->grade }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $item->grade }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <i class="fas fa-chalkboard-teacher me-2 text-success"></i>
                                            {{ $item->dosen->nama ?? '-' }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada nilai untuk mahasiswa ini</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 