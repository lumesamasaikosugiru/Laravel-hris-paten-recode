<?php

namespace Database\Seeders;

use App\Models\Master\EducationLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kode digunakan sebagai bagian dari format NIPY
        // Format NIPY: YY + kode_pendidikan + kode_kategori + nomor_urut
        $levels = [
            ['code' => 'SD', 'name' => 'SD / Sederajat', 'sort_order' => 1],
            ['code' => 'SMP', 'name' => 'SMP / Sederajat', 'sort_order' => 2],
            ['code' => 'SMA', 'name' => 'SMA / Sederajat', 'sort_order' => 3],
            ['code' => 'SMK', 'name' => 'SMK / Sederajat', 'sort_order' => 4],
            ['code' => 'D1', 'name' => 'Diploma 1 (D1)', 'sort_order' => 5],
            ['code' => 'D2', 'name' => 'Diploma 2 (D2)', 'sort_order' => 6],
            ['code' => 'D3', 'name' => 'Diploma 3 (D3)', 'sort_order' => 7],
            ['code' => 'D4', 'name' => 'Diploma 4 (D4)', 'sort_order' => 8],
            ['code' => 'S1', 'name' => 'Sarjana (S1)', 'sort_order' => 9],
            ['code' => 'S2', 'name' => 'Magister (S2)', 'sort_order' => 10],
            ['code' => 'S3', 'name' => 'Doktor (S3)', 'sort_order' => 11],
            ['code' => 'PROF', 'name' => 'Profesi', 'sort_order' => 12],
        ];

        foreach ($levels as $level) {
            EducationLevel::firstOrCreate(
                ['code' => $level['code']],
                [
                    'name' => $level['name'],
                    'sort_order' => $level['sort_order'],
                ]
            );
        }

        $this->command->info('Education levels berhasil dibuat: ' . count($levels) . ' data.');
    }
}
