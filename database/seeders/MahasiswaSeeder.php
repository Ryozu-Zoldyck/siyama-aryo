<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswaData = [
            [
                'nim' => '2021001',
                'nama' => 'Ahmad Rizki Pratama',
                'jurusan' => 'Teknik Informatika',
                'semester' => '3',
                'alamat' => 'Jl. Merdeka No. 15, Yogyakarta',
                'no_telp' => '081234567890',
            ],
            [
                'nim' => '2021002',
                'nama' => 'Siti Nurhaliza Putri',
                'jurusan' => 'Sistem Informasi',
                'semester' => '5',
                'alamat' => 'Jl. Sudirman No. 28, Yogyakarta',
                'no_telp' => '081234567891',
            ],
            [
                'nim' => '2021003',
                'nama' => 'Budi Santoso Wijaya',
                'jurusan' => 'Teknik Informatika',
                'semester' => '3',
                'alamat' => 'Jl. Malioboro No. 42, Yogyakarta',
                'no_telp' => '081234567892',
            ],
            [
                'nim' => '2021004',
                'nama' => 'Dewi Sartika Sari',
                'jurusan' => 'Sistem Informasi',
                'semester' => '5',
                'alamat' => 'Jl. Pramuka No. 7, Yogyakarta',
                'no_telp' => '081234567893',
            ],
            [
                'nim' => '2021005',
                'nama' => 'Muhammad Fadli Rahman',
                'jurusan' => 'Teknik Informatika',
                'semester' => '7',
                'alamat' => 'Jl. Veteran No. 33, Yogyakarta',
                'no_telp' => '081234567894',
            ],
        ];

        foreach ($mahasiswaData as $data) {
            // Cek apakah user sudah ada
            if (!User::where('username', $data['nim'])->exists()) {
                // Buat user untuk mahasiswa
                $user = User::create([
                    'username' => $data['nim'],
                    'password' => Hash::make('mahasiswa123'),
                    'role' => 'mahasiswa',
                ]);

                // Buat data mahasiswa
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'nim' => $data['nim'],
                    'nama' => $data['nama'],
                    'jurusan' => $data['jurusan'],
                    'semester' => $data['semester'],
                    'alamat' => $data['alamat'],
                    'no_telp' => $data['no_telp'],
                ]);

                $this->command->info("Mahasiswa {$data['nama']} (NIM: {$data['nim']}) created successfully!");
            } else {
                $this->command->info("Mahasiswa with NIM {$data['nim']} already exists!");
            }
        }

        $this->command->info('All mahasiswa accounts use password: mahasiswa123');
    }
}
