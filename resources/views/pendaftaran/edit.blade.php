@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Data Pendaftaran
                    </h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Error!</strong> Silakan perbaiki kesalahan berikut:
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label">
                                        <i class="fas fa-user me-2"></i>Nama Lengkap
                                    </label>
                                    <input type="text" 
                                           name="nama" 
                                           id="nama" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           value="{{ old('nama', $pendaftaran->nama) }}" 
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $pendaftaran->email) }}" 
                                           placeholder="Masukkan email"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_telp" class="form-label">
                                        <i class="fas fa-phone me-2"></i>Nomor Telepon
                                    </label>
                                    <input type="text" 
                                           name="no_telp" 
                                           id="no_telp" 
                                           class="form-control @error('no_telp') is-invalid @enderror" 
                                           value="{{ old('no_telp', $pendaftaran->no_telp) }}" 
                                           placeholder="Masukkan nomor telepon">
                                    @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jurusan" class="form-label">
                                        <i class="fas fa-graduation-cap me-2"></i>Jurusan
                                    </label>
                                    <select name="jurusan" 
                                            id="jurusan" 
                                            class="form-control @error('jurusan') is-invalid @enderror" 
                                            required>
                                        <option value="">Pilih Jurusan</option>
                                        <option value="Ilmu Komputer" {{ old('jurusan', $pendaftaran->jurusan) == 'Ilmu Komputer' ? 'selected' : '' }}>Ilmu Komputer</option>
                                        <option value="Sistem Informasi" {{ old('jurusan', $pendaftaran->jurusan) == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                        <option value="Teknik Informatika" {{ old('jurusan', $pendaftaran->jurusan) == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                        <option value="Manajemen Informatika" {{ old('jurusan', $pendaftaran->jurusan) == 'Manajemen Informatika' ? 'selected' : '' }}>Manajemen Informatika</option>
                                    </select>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="form-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat
                            </label>
                            <textarea name="alamat" 
                                      id="alamat" 
                                      class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Masukkan alamat lengkap">{{ old('alamat', $pendaftaran->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">
                                <i class="fas fa-info-circle me-2"></i>Status
                            </label>
                            <select name="status" 
                                    id="status" 
                                    class="form-control @error('status') is-invalid @enderror" 
                                    required>
                                <option value="pending" {{ old('status', $pendaftaran->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $pendaftaran->status) == 'approved' ? 'selected' : '' }}>Diterima</option>
                                <option value="rejected" {{ old('status', $pendaftaran->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 