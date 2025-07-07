@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Nilai Mahasiswa</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="mahasiswa_id">Mahasiswa</label>
                            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control @error('mahasiswa_id') is-invalid @enderror" required>
                                <option value="">Pilih Mahasiswa</option>
                                @foreach($mahasiswa as $mhs)
                                    <option value="{{ $mhs->id }}" {{ old('mahasiswa_id', $nilai->mahasiswa_id) == $mhs->id ? 'selected' : '' }}>
                                        {{ $mhs->nim }} - {{ $mhs->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mahasiswa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mata_kuliah">Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" id="mata_kuliah" class="form-control @error('mata_kuliah') is-invalid @enderror" value="{{ old('mata_kuliah', $nilai->mata_kuliah) }}" required>
                            @error('mata_kuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester', $nilai->semester) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nilai_tugas">Nilai Tugas</label>
                                    <input type="number" name="nilai_tugas" id="nilai_tugas" class="form-control @error('nilai_tugas') is-invalid @enderror" value="{{ old('nilai_tugas', $nilai->nilai_tugas) }}" min="0" max="100" required>
                                    @error('nilai_tugas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nilai_uts">Nilai UTS</label>
                                    <input type="number" name="nilai_uts" id="nilai_uts" class="form-control @error('nilai_uts') is-invalid @enderror" value="{{ old('nilai_uts', $nilai->nilai_uts) }}" min="0" max="100" required>
                                    @error('nilai_uts')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nilai_uas">Nilai UAS</label>
                                    <input type="number" name="nilai_uas" id="nilai_uas" class="form-control @error('nilai_uas') is-invalid @enderror" value="{{ old('nilai_uas', $nilai->nilai_uas) }}" min="0" max="100" required>
                                    @error('nilai_uas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dosen_id">Dosen</label>
                            <select name="dosen_id" id="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror" required>
                                <option value="">Pilih Dosen</option>
                                @foreach($dosen as $dsn)
                                    <option value="{{ $dsn->id }}" {{ old('dosen_id', $nilai->dosen_id) == $dsn->id ? 'selected' : '' }}>
                                        {{ $dsn->nip }} - {{ $dsn->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
