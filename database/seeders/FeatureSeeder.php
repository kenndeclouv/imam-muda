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
        $features = [
            ['name' => 'Semua Fitur', 'code' => 'all_feature'],
            ['name' => 'Tampilkan Imam', 'code' => 'imam_show'],
            ['name' => 'Tambah Imam', 'code' => 'imam_create'],
            ['name' => 'Ubah Imam', 'code' => 'imam_edit'],
            ['name' => 'Hapus Imam', 'code' => 'imam_delete'],
            ['name' => 'Detail Imam', 'code' => 'imam_detail'],
            ['name' => 'Tampilkan Shalat', 'code' => 'shalat_show'],
            ['name' => 'Tambah Shalat', 'code' => 'shalat_create'],
            ['name' => 'Ubah Shalat', 'code' => 'shalat_edit'],
            ['name' => 'Hapus Shalat', 'code' => 'shalat_delete'],
            ['name' => 'Tampilkan Masjid', 'code' => 'masjid_show'],
            ['name' => 'Tambah Masjid', 'code' => 'masjid_create'],
            ['name' => 'Ubah Masjid', 'code' => 'masjid_edit'],
            ['name' => 'Hapus Masjid', 'code' => 'masjid_delete'],
            ['name' => 'Tampilkan Jadwal', 'code' => 'jadwal_show'],
            ['name' => 'Tambah Jadwal', 'code' => 'jadwal_create'],
            ['name' => 'Ubah Jadwal', 'code' => 'jadwal_edit'],
            ['name' => 'Hapus Jadwal', 'code' => 'jadwal_delete'],
            ['name' => 'Tampilkan Bayaran', 'code' => 'bayaran_show'],
            ['name' => 'Tambah Bayaran', 'code' => 'bayaran_create'],
            ['name' => 'Ubah Bayaran', 'code' => 'bayaran_edit'],
            ['name' => 'Hapus Bayaran', 'code' => 'bayaran_delete'],
            ['name' => 'Tampilkan List Bayaran', 'code' => 'bayaran_list'],
            ['name' => 'Tampilkan Pengumuman', 'code' => 'pengumuman_show'],
            ['name' => 'Tambah Pengumuman', 'code' => 'pengumuman_create'],
            ['name' => 'Ubah Pengumuman', 'code' => 'pengumuman_edit'],
            ['name' => 'Hapus Pengumuman', 'code' => 'pengumuman_delete'],
            ['name' => 'Tampilkan Rekap', 'code' => 'rekap_show'],
            ['name' => 'Rekap Berdasarkan Imam', 'code' => 'rekap_berdasarkan_imam'],
            ['name' => 'Rekap Berdasarkan Shalat', 'code' => 'rekap_berdasarkan_shalat'],
            ['name' => 'Tampilkan Statistik', 'code' => 'statistik_show'],
            ['name' => 'Tampilkan Quote', 'code' => 'quote_show'],
            ['name' => 'Tambah Quote', 'code' => 'quote_create'],
            ['name' => 'Ubah Quote', 'code' => 'quote_edit'],
            ['name' => 'Hapus Quote', 'code' => 'quote_delete'],
            ['name' => 'Tampilkan Marbot', 'code' => 'marbot_show'],
            ['name' => 'Tambah Marbot', 'code' => 'marbot_create'],
            ['name' => 'Ubah Marbot', 'code' => 'marbot_edit'],
            ['name' => 'Hapus Marbot', 'code' => 'marbot_delete'],
            ['name' => 'Tampilkan Student', 'code' => 'student_show'],
            ['name' => 'Tambah Student', 'code' => 'student_create'],
            ['name' => 'Ubah Student', 'code' => 'student_edit'],
            ['name' => 'Hapus Student', 'code' => 'student_delete'],
            ['name' => 'Detail Student', 'code' => 'student_detail'],
            ['name' => 'Tampilkan Hafalan', 'code' => 'memorization_show'],
            ['name' => 'Tambah Hafalan', 'code' => 'memorization_create'],
            ['name' => 'Ubah Hafalan', 'code' => 'memorization_edit'],
            ['name' => 'Hapus Hafalan', 'code' => 'memorization_delete'],
        ];

        foreach ($features as $feature) {
            Feature::firstOrCreate($feature);
        }
    }
}
