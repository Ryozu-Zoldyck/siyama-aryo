@extends('layouts.app')

@section('title', 'Edit Dosen')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Data Dosen
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

                    <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip" class="form-label">
                                        <i class="fas fa-id-card me-2"></i>NIP
                                    </label>
                                    <input type="text" 
                                           name="nip" 
                                           id="nip" 
                                           class="form-control @error('nip') is-invalid @enderror" 
                                           value="{{ old('nip', $dosen->nip) }}" 
                                           placeholder="Masukkan NIP"
                                           required>
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label">
                                        <i class="fas fa-user me-2"></i>Nama Lengkap
                                    </label>
                                    <input type="text" 
                                           name="nama" 
                                           id="nama" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           value="{{ old('nama', $dosen->nama) }}" 
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jurusan" class="form-label">
                                <i class="fas fa-graduation-cap me-2"></i>Jurusan
                            </label>
                            <select name="jurusan" 
                                    id="jurusan" 
                                    class="form-control @error('jurusan') is-invalid @enderror" 
                                    required>
                                <option value="">Pilih Jurusan</option>
                                <option value="Ilmu Komputer" {{ old('jurusan', $dosen->jurusan) == 'Ilmu Komputer' ? 'selected' : '' }}>Ilmu Komputer</option>
                                <option value="Sistem Informasi" {{ old('jurusan', $dosen->jurusan) == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                <option value="Teknik Informatika" {{ old('jurusan', $dosen->jurusan) == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                <option value="Manajemen Informatika" {{ old('jurusan', $dosen->jurusan) == 'Manajemen Informatika' ? 'selected' : '' }}>Manajemen Informatika</option>
                            </select>
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="form-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat
                            </label>
                            <textarea name="alamat" 
                                      id="alamat" 
                                      class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Masukkan alamat lengkap">{{ old('alamat', $dosen->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_telp" class="form-label">
                                <i class="fas fa-phone me-2"></i>Nomor Telepon
                            </label>
                            <input type="text" 
                                   name="no_telp" 
                                   id="no_telp" 
                                   class="form-control @error('no_telp') is-invalid @enderror" 
                                   value="{{ old('no_telp', $dosen->no_telp) }}" 
                                   placeholder="Masukkan nomor telepon">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
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