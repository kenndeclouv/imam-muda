<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Feature;
use App\Models\Fee;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Permission;
use App\Models\Quote;
use App\Models\Role;
use App\Models\Shalat;
use App\Models\User;
use Illuminate\Database\Seeder;

class MySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'code' => 'superadmin',
            'name' => 'Super Admin',
        ]);
        Role::create([
            'code' => 'admin',
            'name' => 'Admin',
        ]);
        Role::create([
            'code' => 'imam',
            'name' => 'Imam',
        ]);

        User::create([
            'name' => 'Ustadz Rujian',
            'email' => 'superadmin@gmail.com',
            'username' => 'superadmin',
            'password' => 'superadmin',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Ustadz Alfin Shahih',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => 'admin',
            'role_id' => 2,
        ]);

        Admin::create([
            'user_id' => 2,
            'fullname' => 'Ustadz Alfin Shahih',
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'birthdate' => fake()->date(),
            'birthplace' => fake()->city(),
            'description' => fake()->realText(20),
        ]);

        User::create([
            'name' => 'Imam',
            'email' => 'imam@gmail.com',
            'username' => 'imam',
            'password' => 'imam',
            'role_id' => 3,
        ]);

        Imam::create([
            'user_id' => 3,
            'fullname' => 'Imam 1',
            'phone' => fake()->phoneNumber,
            'birthplace' => fake()->city(),
            'birthdate' => fake()->date(),
            'juz' => rand(1, 30),
            'address' => fake()->address,
            'description' => fake()->text(20),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $name = fake()->firstName;
            $user = User::create([
                'name' => $name,
                'email' => fake()->email,
                'username' => strtolower($name),
                'password' => 'password',
                'role_id' => 3,
            ]);
            $imam = Imam::create([
                'user_id' => $user->id,
                'fullname' => $name,
                'phone' => fake()->phoneNumber,
                'birthplace' => fake()->city(),
                'birthdate' => fake()->date(),
                'juz' => rand(1, 30),
                'address' => fake()->address,
                'description' => fake()->text(20),
            ]);

            Fee::create([
                'imam_id' => $imam->id,
                'fee' => rand(1000, 10000),
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            Masjid::create([
                'name' => 'Masjid ' . $i,
                'address' => fake()->address,
            ]);
        }

        Shalat::create([
            'name' => 'Subuh',
            'start' => '04:00:00',
            'end' => '05:00:00',
        ]);
        Shalat::create([
            'name' => 'Dzuhur',
            'start' => '12:00:00',
            'end' => '13:00:00',
        ]);
        Shalat::create([
            'name' => 'Ashar',
            'start' => '15:00:00',
            'end' => '16:00:00',
        ]);

        // Quote
        // for ($i = 1; $i <= 20; $i++) {
        //     $quote = fake()->realText(220);
        //     Quote::create([
        //         'content' => $quote,
        //         'source' => fake()->name,
        //         'tags' => fake()->randomElement(['quran', 'hadits', 'perkataan ulama']),
        //         'length' => strlen($quote),
        //     ]);
        // }

        Feature::create([
            'name' => 'Semua Fitur',
            'code' => 'all_feature',
        ]);
        Feature::create([
            'name' => 'Tampilkan Imam',
            'code' => 'imam_show',
        ]);
        Feature::create([
            'name' => 'Tambah Imam',
            'code' => 'imam_create',
        ]);
        Feature::create([
            'name' => 'Ubah Imam',
            'code' => 'imam_edit',
        ]);
        Feature::create([
            'name' => 'Hapus Imam',
            'code' => 'imam_delete',
        ]);
        Feature::create([
            'name' => 'Tampilkan Shalat',
            'code' => 'shalat_show',
        ]);
        Feature::create([
            'name' => 'Tambah Shalat',
            'code' => 'shalat_create',
        ]);
        Feature::create([
            'name' => 'Ubah Shalat',
            'code' => 'shalat_edit',
        ]);
        Feature::create([
            'name' => 'Hapus Shalat',
            'code' => 'shalat_delete',
        ]);
        Feature::create([
            'name' => 'Tampilkan Masjid',
            'code' => 'masjid_show',
        ]);
        Feature::create([
            'name' => 'Tambah Masjid',
            'code' => 'masjid_create',
        ]);
        Feature::create([
            'name' => 'Ubah Masjid',
            'code' => 'masjid_edit',
        ]);
        Feature::create([
            'name' => 'Hapus Masjid',
            'code' => 'masjid_delete',
        ]);
        Feature::create([
            'name' => 'Tampilkan Jadwal',
            'code' => 'jadwal_show',
        ]);
        Feature::create([
            'name' => 'Tambah Jadwal',
            'code' => 'jadwal_create',
        ]);
        Feature::create([
            'name' => 'Ubah Jadwal',
            'code' => 'jadwal_edit',
        ]);
        Feature::create([
            'name' => 'Hapus Jadwal',
            'code' => 'jadwal_delete',
        ]);
        Feature::create([
            'name' => 'Tampilkan Bayaran',
            'code' => 'bayaran_show',
        ]);
        Feature::create([
            'name' => 'Tambah Bayaran',
            'code' => 'bayaran_create',
        ]);
        Feature::create([
            'name' => 'Ubah Bayaran',
            'code' => 'bayaran_edit',
        ]);
        Feature::create([
            'name' => 'Hapus Bayaran',
            'code' => 'bayaran_delete',
        ]);
        Feature::create([
            'name' => 'Tampilkan Pengumuman',
            'code' => 'pengumuman_show',
        ]);
        Feature::create([
            'name' => 'Tambah Pengumuman',
            'code' => 'pengumuman_create',
        ]);
        Feature::create([
            'name' => 'Ubah Pengumuman',
            'code' => 'pengumuman_edit',
        ]);
        Feature::create([
            'name' => 'Hapus Pengumuman',
            'code' => 'pengumuman_delete',
        ]);
        Feature::create([
            'name' => 'Tampilkan Rekap',
            'code' => 'rekap_show',
        ]);
        Feature::create([
            'name' => 'Tampilkan Statistik',
            'code' => 'statistik_show',
        ]);

        // for ($i = 1; $i <= 26; $i++) {
        //     Permission::create([
        //         'admin_id' => 1,
        //         'feature_id' => $i
        //     ]);
        // }
        Permission::create([
            'user_id' => 2,
            'feature_id' => 1
        ]);
    }
}
