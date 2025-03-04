<?php

use Carbon\Carbon;

if (!function_exists('indonesianCurrency')) {
    /**
     * Format number to Indonesian Rupiah currency format
     * 
     * @param mixed $number Number to format
     * @return string Formatted currency string
     */
    function indonesianCurrency($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('formatDate')) {
    /**
     * Format date to Indonesian date format
     * 
     * @param mixed $date Date to format
     * @param string $format Format to use
     * @return string Formatted date string
     */
    function formatDate($date, $format = 'd F Y')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('getSurahName')) {
    /**
     * Get the name of a Surah by its number.
     * 
     * @param int $number Surah number (1-114)
     * @return string|null Surah name or null if not found
     */
    function getSurahName($number)
    {
        $surah = [
            1 => 'Al-Fatihah',
            2 => 'Al-Baqarah',
            3 => 'Ali Imran',
            4 => 'An-Nisa',
            5 => 'Al-Maidah',
            6 => 'Al-An\'am',
            7 => 'Al-A\'raf',
            8 => 'Al-Anfal',
            9 => 'At-Taubah',
            10 => 'Yunus',
            11 => 'Hud',
            12 => 'Yusuf',
            13 => 'Ar-Ra\'d',
            14 => 'Ibrahim',
            15 => 'Al-Hijr',
            16 => 'An-Nahl',
            17 => 'Al-Isra',
            18 => 'Al-Kahf',
            19 => 'Maryam',
            20 => 'Ta Ha',
            21 => 'Al-Anbiya',
            22 => 'Al-Hajj',
            23 => 'Al-Mu\'minun',
            24 => 'An-Nur',
            25 => 'Al-Furqan',
            26 => 'Asy-Syu\'ara',
            27 => 'An-Naml',
            28 => 'Al-Qasas',
            29 => 'Al-Ankabut',
            30 => 'Ar-Rum',
            31 => 'Luqman',
            32 => 'As-Sajdah',
            33 => 'Al-Ahzab',
            34 => 'Saba',
            35 => 'Fatir',
            36 => 'Ya Sin',
            37 => 'As-Saffat',
            38 => 'Sad',
            39 => 'Az-Zumar',
            40 => 'Ghafir',
            41 => 'Fussilat',
            42 => 'Asy-Syura',
            43 => 'Az-Zukhruf',
            44 => 'Ad-Dukhan',
            45 => 'Al-Jasiyah',
            46 => 'Al-Ahqaf',
            47 => 'Muhammad',
            48 => 'Al-Fath',
            49 => 'Al-Hujurat',
            50 => 'Qaf',
            51 => 'Az-Zariyat',
            52 => 'At-Tur',
            53 => 'An-Najm',
            54 => 'Al-Qamar',
            55 => 'Ar-Rahman',
            56 => 'Al-Waqi\'ah',
            57 => 'Al-Hadid',
            58 => 'Al-Mujadilah',
            59 => 'Al-Hasyr',
            60 => 'Al-Mumtahanah',
            61 => 'As-Saff',
            62 => 'Al-Jumu\'ah',
            63 => 'Al-Munafiqun',
            64 => 'At-Taghabun',
            65 => 'At-Talaq',
            66 => 'At-Tahrim',
            67 => 'Al-Mulk',
            68 => 'Al-Qalam',
            69 => 'Al-Haqqah',
            70 => 'Al-Ma\'arij',
            71 => 'Nuh',
            72 => 'Al-Jinn',
            73 => 'Al-Muzzammil',
            74 => 'Al-Muddassir',
            75 => 'Al-Qiyamah',
            76 => 'Al-Insan',
            77 => 'Al-Mursalat',
            78 => 'An-Naba',
            79 => 'An-Nazi\'at',
            80 => 'Abasa',
            81 => 'At-Takwir',
            82 => 'Al-Infitar',
            83 => 'Al-Mutaffifin',
            84 => 'Al-Insyiqaq',
            85 => 'Al-Buruj',
            86 => 'At-Tariq',
            87 => 'Al-A\'la',
            88 => 'Al-Ghasyiyah',
            89 => 'Al-Fajr',
            90 => 'Al-Balad',
            91 => 'Ash-Shams',
            92 => 'Al-Layl',
            93 => 'Ad-Duha',
            94 => 'Ash-Sharh',
            95 => 'At-Tin',
            96 => 'Al-Alaq',
            97 => 'Al-Qadr',
            98 => 'Al-Bayyinah',
            99 => 'Az-Zalzalah',
            100 => 'Al-Adiyat',
            101 => 'Al-Qari\'ah',
            102 => 'At-Takathur',
            103 => 'Al-Asr',
            104 => 'Al-Humazah',
            105 => 'Al-Fil',
            106 => 'Quraish',
            107 => 'Al-Maun',
            108 => 'Al-Kauthar',
            109 => 'Al-Kafirun',
            110 => 'An-Nasr',
            111 => 'Al-Masad',
            112 => 'Al-Ikhlas',
            113 => 'Al-Falaq',
            114 => 'An-Nas'
        ];

        return $surah[$number] ?? 'Surah tidak ditemukan';
    }

    if (!function_exists('getIndonesianMonthName')) {
        /**
         * Get the name of a month by its number.
         * 
         * @param int $number Month number (1-12)
         * @return string|null Month name or null if not found
         */
        function getIndonesianMonthName($number)
        {
            $month = [
                "January" => 'Januari',
                "February" => 'Februari',
                "March" => 'Maret',
                "April" => 'April',
                "May" => 'Mei',
                "June" => 'Juni',
                "July" => 'Juli',
                "August" => 'Agustus',
                "September" => 'September',
                "October" => 'Oktober',
                "November" => 'November',
                "December" => 'Desember'
            ];

            return $month[$number] ?? 'Bulan tidak ditemukan';
        }
    }
}
