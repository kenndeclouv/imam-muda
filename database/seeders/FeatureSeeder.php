<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            'name' => 'Detail Imam',
            'code' => 'imam_detail',
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
            'name' => 'Tampilkan List Bayaran',
            'code' => 'bayaran_list',
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
            'name' => 'Rekap Berdasarkan Imam',
            'code' => 'rekap_berdasarkan_imam',
        ]);
        Feature::create([
            'name' => 'Rekap Berdasarkan Shalat',
            'code' => 'rekap_berdasarkan_shalat',
        ]);
        Feature::create([
            'name' => 'Tampilkan Statistik',
            'code' => 'statistik_show',
        ]);
    }
}
