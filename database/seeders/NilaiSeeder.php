<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();

        if ($mahasiswa->count() > 0 && $dosen->count() > 0) {
            $nilaiData = [
                // Semester 3 - Teknik Informatika
                [
                    'mahasiswa_nim' => '2021001',
                    'dosen_nip' => '198501012010012001',
                    'mata_kuliah' => 'Pemrograman Web',
                    'semester' => '3',
                    'nilai_tugas' => 85,
                    'nilai_uts' => 80,
                    'nilai_uas' => 90,
                ],
                [
                    'mahasiswa_nim' => '2021001',
                    'dosen_nip' => '198503032010012003',
                    'mata_kuliah' => 'Basis Data',
                    'semester' => '3',
                    'nilai_tugas' => 90,
                    'nilai_uts' => 85,
                    'nilai_uas' => 88,
                ],
                [
                    'mahasiswa_nim' => '2021001',
                    'dosen_nip' => '198505052010012005',
                    'mata_kuliah' => 'Algoritma dan Struktur Data',
                    'semester' => '3',
                    'nilai_tugas' => 88,
                    'nilai_uts' => 82,
                    'nilai_uas' => 85,
                ],
                [
                    'mahasiswa_nim' => '2021003',
                    'dosen_nip' => '198501012010012001',
                    'mata_kuliah' => 'Pemrograman Web',
                    'semester' => '3',
                    'nilai_tugas' => 75,
                    'nilai_uts' => 70,
                    'nilai_uas' => 80,
                ],
                [
                    'mahasiswa_nim' => '2021003',
                    'dosen_nip' => '198503032010012003',
                    'mata_kuliah' => 'Basis Data',
                    'semester' => '3',
                    'nilai_tugas' => 82,
                    'nilai_uts' => 78,
                    'nilai_uas' => 85,
                ],
                [
                    'mahasiswa_nim' => '2021003',
                    'dosen_nip' => '198505052010012005',
                    'mata_kuliah' => 'Algoritma dan Struktur Data',
                    'semester' => '3',
                    'nilai_tugas' => 90,
                    'nilai_uts' => 88,
                    'nilai_uas' => 92,
                ],
                
                // Semester 5 - Sistem Informasi
                [
                    'mahasiswa_nim' => '2021002',
                    'dosen_nip' => '198502022010012002',
                    'mata_kuliah' => 'Analisis dan Perancangan Sistem',
                    'semester' => '5',
                    'nilai_tugas' => 88,
                    'nilai_uts' => 85,
                    'nilai_uas' => 92,
                ],
                [
                    'mahasiswa_nim' => '2021002',
                    'dosen_nip' => '198504042010012004',
                    'mata_kuliah' => 'Manajemen Proyek TI',
                    'semester' => '5',
                    'nilai_tugas' => 85,
                    'nilai_uts' => 80,
                    'nilai_uas' => 88,
                ],
                [
                    'mahasiswa_nim' => '2021002',
                    'dosen_nip' => '198501012010012001',
                    'mata_kuliah' => 'Pemrograman Berorientasi Objek',
                    'semester' => '5',
                    'nilai_tugas' => 92,
                    'nilai_uts' => 88,
                    'nilai_uas' => 90,
                ],
                [
                    'mahasiswa_nim' => '2021004',
                    'dosen_nip' => '198502022010012002',
                    'mata_kuliah' => 'Analisis dan Perancangan Sistem',
                    'semester' => '5',
                    'nilai_tugas' => 78,
                    'nilai_uts' => 75,
                    'nilai_uas' => 82,
                ],
                [
                    'mahasiswa_nim' => '2021004',
                    'dosen_nip' => '198504042010012004',
                    'mata_kuliah' => 'Manajemen Proyek TI',
                    'semester' => '5',
                    'nilai_tugas' => 85,
                    'nilai_uts' => 82,
                    'nilai_uas' => 88,
                ],
                [
                    'mahasiswa_nim' => '2021004',
                    'dosen_nip' => '198501012010012001',
                    'mata_kuliah' => 'Pemrograman Berorientasi Objek',
                    'semester' => '5',
                    'nilai_tugas' => 90,
                    'nilai_uts' => 85,
                    'nilai_uas' => 92,
                ],
                
                // Semester 7 - Teknik Informatika
                [
                    'mahasiswa_nim' => '2021005',
                    'dosen_nip' => '198503032010012003',
                    'mata_kuliah' => 'Machine Learning',
                    'semester' => '7',
                    'nilai_tugas' => 92,
                    'nilai_uts' => 88,
                    'nilai_uas' => 95,
                ],
                [
                    'mahasiswa_nim' => '2021005',
                    'dosen_nip' => '198505052010012005',
                    'mata_kuliah' => 'Kecerdasan Buatan',
                    'semester' => '7',
                    'nilai_tugas' => 88,
                    'nilai_uts' => 85,
                    'nilai_uas' => 90,
                ],
                [
                    'mahasiswa_nim' => '2021005',
                    'dosen_nip' => '198501012010012001',
                    'mata_kuliah' => 'Pengembangan Aplikasi Mobile',
                    'semester' => '7',
                    'nilai_tugas' => 85,
                    'nilai_uts' => 80,
                    'nilai_uas' => 88,
                ],
            ];

            foreach ($nilaiData as $data) {
                $mahasiswa = Mahasiswa::where('nim', $data['mahasiswa_nim'])->first();
                $dosen = Dosen::where('nip', $data['dosen_nip'])->first();

                if ($mahasiswa && $dosen) {
                    // Cek apakah nilai sudah ada
                    $existingNilai = Nilai::where('mahasiswa_id', $mahasiswa->id)
                        ->where('dosen_id', $dosen->id)
                        ->where('mata_kuliah', $data['mata_kuliah'])
                        ->where('semester', $data['semester'])
                        ->first();

                    if (!$existingNilai) {
                        // Hitung nilai akhir (30% tugas + 30% UTS + 40% UAS)
                        $nilai_akhir = ($data['nilai_tugas'] * 0.3) + ($data['nilai_uts'] * 0.3) + ($data['nilai_uas'] * 0.4);
                        
                        // Tentukan grade berdasarkan nilai akhir
                        $grade = $this->hitungGrade($nilai_akhir);

                        Nilai::create([
                            'mahasiswa_id' => $mahasiswa->id,
                            'dosen_id' => $dosen->id,
                            'mata_kuliah' => $data['mata_kuliah'],
                            'semester' => $data['semester'],
                            'nilai_tugas' => $data['nilai_tugas'],
                            'nilai_uts' => $data['nilai_uts'],
                            'nilai_uas' => $data['nilai_uas'],
                            'nilai_akhir' => round($nilai_akhir, 2),
                            'grade' => $grade,
                        ]);

                        $this->command->info("Nilai {$data['mata_kuliah']} untuk {$mahasiswa->nama} created successfully!");
                    } else {
                        $this->command->info("Nilai {$data['mata_kuliah']} untuk {$mahasiswa->nama} already exists!");
                    }
                }
            }
        }
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
