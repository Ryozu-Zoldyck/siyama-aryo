<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosenData = [
            [
                'nip' => '198501012010012001',
                'nama' => 'Dr. Ir. Ahmad Hidayat, M.Kom.',
                'jurusan' => 'Teknik Informatika',
                'alamat' => 'Jl. Prof. Dr. Soepomo No. 1, Yogyakarta',
                'no_telp' => '081234567895',
            ],
            [
                'nip' => '198502022010012002',
                'nama' => 'Dr. Siti Nurhaliza, S.Kom., M.T.',
                'jurusan' => 'Sistem Informasi',
                'alamat' => 'Jl. Prof. Dr. Soepomo No. 2, Yogyakarta',
                'no_telp' => '081234567896',
            ],
            [
                'nip' => '198503032010012003',
                'nama' => 'Prof. Dr. Bambang Sutrisno, S.Kom., M.Sc.',
                'jurusan' => 'Teknik Informatika',
                'alamat' => 'Jl. Prof. Dr. Soepomo No. 3, Yogyakarta',
                'no_telp' => '081234567897',
            ],
            [
                'nip' => '198504042010012004',
                'nama' => 'Dr. Rina Dewi Sartika, S.Kom., M.T.',
                'jurusan' => 'Sistem Informasi',
                'alamat' => 'Jl. Prof. Dr. Soepomo No. 4, Yogyakarta',
                'no_telp' => '081234567898',
            ],
            [
                'nip' => '198505052010012005',
                'nama' => 'Dr. Muhammad Fadli, S.Kom., M.Kom.',
                'jurusan' => 'Teknik Informatika',
                'alamat' => 'Jl. Prof. Dr. Soepomo No. 5, Yogyakarta',
                'no_telp' => '081234567899',
            ],
        ];

        foreach ($dosenData as $data) {
            // Cek apakah user sudah ada
            if (!User::where('username', $data['nip'])->exists()) {
                // Buat user untuk dosen
                $user = User::create([
                    'username' => $data['nip'],
                    'password' => Hash::make('dosen123'),
                    'role' => 'dosen',
                ]);

                // Buat data dosen
                Dosen::create([
                    'user_id' => $user->id,
                    'nip' => $data['nip'],
                    'nama' => $data['nama'],
                    'jurusan' => $data['jurusan'],
                    'alamat' => $data['alamat'],
                    'no_telp' => $data['no_telp'],
                ]);

                $this->command->info("Dosen {$data['nama']} (NIP: {$data['nip']}) created successfully!");
            } else {
                $this->command->info("Dosen with NIP {$data['nip']} already exists!");
            }
        }

        $this->command->info('All dosen accounts use password: dosen123');
    }
}
