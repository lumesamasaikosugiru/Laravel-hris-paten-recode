<?php

namespace Database\Seeders;

use App\Models\Master\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sesuai regulasi ketenagakerjaan Indonesia
        $leaveTypes = [
            [
                'name' => 'Cuti Tahunan',
                'default_days' => 12,
                'requires_approval' => true,
                'description' => 'Hak cuti tahunan sesuai UU Ketenagakerjaan',
            ],
            [
                'name' => 'Cuti Sakit',
                'default_days' => 14,
                'requires_approval' => true,
                'description' => 'Cuti karena sakit dengan surat dokter',
            ],
            [
                'name' => 'Cuti Melahirkan',
                'default_days' => 90,
                'requires_approval' => true,
                'description' => 'Cuti melahirkan 3 bulan sesuai UU',
            ],
            [
                'name' => 'Cuti Menikah',
                'default_days' => 3,
                'requires_approval' => true,
                'description' => 'Cuti untuk pernikahan pegawai',
            ],
            [
                'name' => 'Cuti Duka',
                'default_days' => 3,
                'requires_approval' => false,
                'description' => 'Cuti karena anggota keluarga inti meninggal',
            ],
            [
                'name' => 'Cuti Haji / Umroh',
                'default_days' => 40,
                'requires_approval' => true,
                'description' => 'Cuti ibadah haji atau umroh',
            ],
            [
                'name' => 'Izin Tidak Masuk',
                'default_days' => 0,   // tidak ada jatah, case by case
                'requires_approval' => true,
                'description' => 'Izin tidak masuk tanpa keterangan sakit',
            ],
        ];

        foreach ($leaveTypes as $type) {
            LeaveType::firstOrCreate(
                ['name' => $type['name']],
                [
                    'default_days' => $type['default_days'],
                    'requires_approval' => $type['requires_approval'],
                    'description' => $type['description'],
                ]
            );
        }

        $this->command->info('Leave types berhasil dibuat: ' . count($leaveTypes) . ' data.');
    }
}
