<?php

namespace Database\Seeders;

use App\Models\Master\EmployeeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // probation_months disimpan di sini, BUKAN hardcode di service
        // Sesuai spesifikasi:
        //   Guru Tidak Tetap (12)   → 6 bulan
        //   Tendik Tidak Tetap (22) → 3 bulan
        //   Tetap (11, 21)          → 0 (tidak ada probation)
        $categories = [
            [
                'code' => 11,
                'name' => 'Guru Tetap',
                'probation_months' => 0,
            ],
            [
                'code' => 12,
                'name' => 'Guru Tidak Tetap',
                'probation_months' => 6,
            ],
            [
                'code' => 21,
                'name' => 'Tenaga Kependidikan Tetap',
                'probation_months' => 0,
            ],
            [
                'code' => 22,
                'name' => 'Tenaga Kependidikan Tidak Tetap',
                'probation_months' => 3,
            ],
        ];

        foreach ($categories as $category) {
            EmployeeCategory::firstOrCreate(
                ['code' => $category['code']],
                [
                    'name' => $category['name'],
                    'probation_months' => $category['probation_months'],
                ]
            );
        }

        $this->command->info('Employee categories berhasil dibuat: ' . count($categories) . ' data.');
    }
}
