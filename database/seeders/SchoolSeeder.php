<?php

namespace Database\Seeders;

use App\Models\Master\Department;
use App\Models\Master\Position;
use App\Models\Master\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ganti data ini sesuai yayasan kamu
        $schools = [
            [
                'name' => 'SMP YP Fatahillah Cilegon',
                'level_code' => 'SMP',
                'npsn' => '20000001',
                'address' => 'Jl. Contoh No. 1, Jakarta',
                'phone' => '021-0000001',
                'email' => 'smp@ypfc.sch.id',
                'is_active' => true,
            ],
            [
                'name' => 'SMK YP Fatahillah 2 Cilegon',
                'level_code' => 'SMK',
                'npsn' => '20000002',
                'address' => 'Jl. Contoh No. 2, Jakarta',
                'phone' => '021-0000002',
                'email' => 'smk@ypfc.sch.id',
                'is_active' => true,
            ],
        ];

        foreach ($schools as $schoolData) {
            $school = School::firstOrCreate(
                ['npsn' => $schoolData['npsn']],
                $schoolData
            );

            // Buat department default per sekolah
            $this->seedDepartments($school);

            // Buat posisi default per sekolah
            $this->seedPositions($school);
        }

        $this->command->info('Schools, departments, dan positions berhasil dibuat.');
    }

    private function seedDepartments(School $school): void
    {
        $departments = [
            'Kurikulum',
            'Kesiswaan',
            'Sarana Prasarana',
            'Tata Usaha',
            'Hubungan Masyarakat',
        ];

        foreach ($departments as $name) {
            Department::firstOrCreate([
                'school_id' => $school->id,
                'name' => $name,
            ]);
        }
    }

    private function seedPositions(School $school): void
    {
        $positions = [
            'Kepala Sekolah',
            'Wakil Kepala Sekolah',
            'Guru',
            'Wali Kelas',
            'Staff Tata Usaha',
            'Bendahara',
            'Operator Sekolah',
            'Satpam',
            'Kebersihan',
        ];

        foreach ($positions as $name) {
            Position::firstOrCreate([
                'school_id' => $school->id,
                'name' => $name,
            ]);
        }
    }
}
