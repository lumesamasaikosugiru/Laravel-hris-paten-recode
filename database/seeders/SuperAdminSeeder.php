<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'superadmin@hris.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'is_active' => true,
            ]
        );

        $user->syncRoles(['super_admin']);

        // Buat juga akun HR Admin untuk testing
        $hrAdmin = User::firstOrCreate(
            ['email' => 'hradmin@hris.id'],
            [
                'name' => 'HR Admin',
                'password' => Hash::make('password123'),
                'is_active' => true,
            ]
        );

        $hrAdmin->syncRoles(['hr_admin']);

        $this->command->info('Default users berhasil dibuat:');
        $this->command->table(
            ['Email', 'Role', 'Password'],
            [
                ['superadmin@hris.id', 'super_admin', 'password123'],
                ['hradmin@hris.id', 'hr_admin', 'password123'],
            ]
        );
    }
}
