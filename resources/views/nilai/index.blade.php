@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>Data Nilai Mahasiswa
                    </h4>
                    <a href="{{ route('nilai.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Nilai
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Mata Kuliah</th>
                                    <th>Semester</th>
                                    <th>Nilai Tugas</th>
                                    <th>Nilai UTS</th>
                                    <th>Nilai UAS</th>
                                    <th>Nilai Akhir</th>
                                    <th>Grade</th>
                                    <th>Dosen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nilai as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $item->mahasiswa->nim }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-graduate me-2 text-primary"></i>
                                            {{ $item->mahasiswa->nama }}
                                        </div>
                                    </td>
                                    <td>{{ $item->mata_kuliah }}</td>
                                    <td>
                                        <span class="badge badge-warning">Semester {{ $item->semester }}</span>
                                    </td>
                                    <td>{{ $item->nilai_tugas }}</td>
                                    <td>{{ $item->nilai_uts }}</td>
                                    <td>{{ $item->nilai_uas }}</td>
                                    <td>
                                        <strong>{{ $item->nilai_akhir }}</strong>
                                    </td>
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
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-chalkboard-teacher me-2 text-success"></i>
                                            {{ $item->dosen->nama }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Tidak ada data nilai</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
