<?php

namespace Database\Seeders;

use App\Models\HR\Employee;
use App\Models\Master\EducationLevel;
use App\Models\Master\EmployeeCategory;
use App\Models\Master\School;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Membuat demo data...');

        $school = School::first();
        $category = EmployeeCategory::where('code', 12)->first(); // Guru Tidak Tetap
        $eduLevel = EducationLevel::where('code', 'S1')->first();

        if (!$school || !$category || !$eduLevel) {
            $this->command->error('Master data belum lengkap. Jalankan master seeder dulu.');
            return;
        }

        // Buat user untuk kepala sekolah
        $kepalaUser = User::firstOrCreate(
            ['email' => 'kepala@hris.id'],
            [
                'name' => 'Kepala Sekolah Demo',
                'password' => Hash::make('password123'),
                'is_active' => true,
            ]
        );
        $kepalaUser->syncRoles(['kepala_sekolah']);

        // Buat 3 employee demo dengan skenario berbeda
        $employees = [
            [
                'label' => 'Pegawai aktif (sudah punya NIPY)',
                'join_date' => now()->subYear(),
                'status' => Employee::STATUS_ACTIVE,
                'nipy' => '2503120001',
                'probation_end_date' => now()->subMonths(6),
            ],
            [
                'label' => 'Pegawai probation (belum eligible NIPY)',
                'join_date' => now()->subMonths(3),
                'status' => Employee::STATUS_PROBATION,
                'nipy' => null,
                'probation_end_date' => now()->addMonths(3),
            ],
            [
                'label' => 'Pegawai eligible NIPY (probation selesai, belum generate)',
                'join_date' => now()->subMonths(7),
                'status' => Employee::STATUS_ACTIVE,
                'nipy' => null,
                'probation_end_date' => now()->subDays(5), // sudah lewat
            ],
        ];

        foreach ($employees as $index => $data) {
            $no = $index + 1;

            $user = User::firstOrCreate(
                ['email' => "pegawai{$no}@hris.id"],
                [
                    'name' => "Pegawai Demo {$no}",
                    'password' => Hash::make('password123'),
                    'is_active' => true,
                ]
            );
            $user->syncRoles(['employee']);

            Employee::firstOrCreate(
                ['ktp' => "320000000000000{$no}"],
                [
                    'user_id' => $user->id,
                    'school_id' => $school->id,
                    'employee_category_id' => $category->id,
                    'education_level_id' => $eduLevel->id,
                    'full_name' => "Pegawai Demo {$no}",
                    'email' => "pegawai{$no}@hris.id",
                    'gender' => 'L',
                    'birthday' => Carbon::parse('1990-01-0' . $no),
                    'birthplace' => 'Jakarta',
                    'marital_status' => 'single',
                    'phone' => "0812000000{$no}",
                    'address' => "Jl. Demo No. {$no}, Jakarta",
                    'join_date' => $data['join_date'],
                    'status' => $data['status'],
                    'nipy' => $data['nipy'],
                    'nipy_generated_at' => $data['nipy'] ? now() : null,
                    'probation_end_date' => $data['probation_end_date'],
                ]
            );

            $this->command->info("✓ {$data['label']}");
        }

        $this->command->info('Demo data berhasil dibuat.');
        $this->command->table(
            ['Email', 'Role', 'Password'],
            [
                ['kepala@hris.id', 'kepala_sekolah', 'password123'],
                ['pegawai1@hris.id', 'employee', 'password123'],
                ['pegawai2@hris.id', 'employee', 'password123'],
                ['pegawai3@hris.id', 'employee', 'password123'],
            ]
        );
    }
}
