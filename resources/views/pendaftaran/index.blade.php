@extends('layouts.app')

@section('title', 'Data Pendaftaran')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Data Pendaftaran Mahasiswa Baru
                    </h4>
                    <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Pendaftaran
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telp</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftaran as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user me-2 text-primary"></i>
                                            {{ $item->nama }}
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-envelope me-2 text-info"></i>
                                        {{ $item->email }}
                                    </td>
                                    <td>{{ $item->no_telp ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $item->jurusan }}</span>
                                    </td>
                                    <td>
                                        @if($item->status === 'pending')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        @elseif($item->status === 'approved')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check me-1"></i>Diterima
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times me-1"></i>Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar me-2 text-muted"></i>
                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pendaftaran.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pendaftaran.destroy', $item->id) }}" method="POST" class="d-inline">
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
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Tidak ada data pendaftaran</p>
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