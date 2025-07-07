@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Nilai Saya</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($nilai->count() > 0)
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
                                    @foreach($nilai as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->mata_kuliah }}</td>
                                        <td>{{ $item->semester }}</td>
                                        <td>{{ $item->nilai_tugas }}</td>
                                        <td>{{ $item->nilai_uts }}</td>
                                        <td>{{ $item->nilai_uas }}</td>
                                        <td>{{ $item->nilai_akhir }}</td>
                                        <td>
                                            <span class="badge badge-{{ $item->grade == 'A' ? 'success' : ($item->grade == 'B' ? 'info' : ($item->grade == 'C' ? 'warning' : 'danger')) }}">
                                                {{ $item->grade }}
                                            </span>
                                        </td>
                                        <td>{{ $item->dosen->nama }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Statistik Nilai</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Total Mata Kuliah:</strong> {{ $nilai->count() }}</p>
                                        <p><strong>Rata-rata Nilai Akhir:</strong> {{ number_format($nilai->avg('nilai_akhir'), 2) }}</p>
                                        <p><strong>Nilai Tertinggi:</strong> {{ $nilai->max('nilai_akhir') }}</p>
                                        <p><strong>Nilai Terendah:</strong> {{ $nilai->min('nilai_akhir') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Distribusi Grade</h5>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $gradeA = $nilai->where('grade', 'A')->count();
                                            $gradeB = $nilai->where('grade', 'B')->count();
                                            $gradeC = $nilai->where('grade', 'C')->count();
                                            $gradeD = $nilai->where('grade', 'D')->count();
                                            $gradeE = $nilai->where('grade', 'E')->count();
                                        @endphp
                                        <p><span class="badge badge-success">A:</span> {{ $gradeA }} mata kuliah</p>
                                        <p><span class="badge badge-info">B:</span> {{ $gradeB }} mata kuliah</p>
                                        <p><span class="badge badge-warning">C:</span> {{ $gradeC }} mata kuliah</p>
                                        <p><span class="badge badge-danger">D:</span> {{ $gradeD }} mata kuliah</p>
                                        <p><span class="badge badge-danger">E:</span> {{ $gradeE }} mata kuliah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <h5>Belum ada data nilai</h5>
                            <p class="text-muted">Nilai Anda akan muncul di sini setelah dosen menginput nilai.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
