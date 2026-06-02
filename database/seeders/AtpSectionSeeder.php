<?php

namespace Database\Seeders;

use App\Models\AtpSection;
use Illuminate\Database\Seeder;

class AtpSectionSeeder extends Seeder
{
    public function run(): void
    {
        AtpSection::truncate();

        // ── CP ──────────────────────────────────────────────
        $cp = [
            [
                'topik' => 'zakat',
                'sub_judul' => 'CP — Zakat',
                'judul' => 'Peserta didik memahami ketentuan zakat fitrah dan zakat maal',
                'isi' => 'Peserta didik mampu menjelaskan pengertian, dalil, syarat, rukun, dan ketentuan zakat fitrah serta zakat maal; mengidentifikasi muzakki dan mustahiq zakat; menghitung kadar zakat maal berdasarkan nisab dan haul; serta menganalisis implementasi zakat di lembaga amil zakat modern seperti BAZNAS.',
                'urutan' => 1
            ],
            [
                'topik' => 'mawaris',
                'sub_judul' => 'CP — Mawaris',
                'badge_style' => 'background:linear-gradient(135deg,#1A3A5C,var(--navy-light))',
                'judul' => 'Peserta didik memahami ketentuan pembagian harta warisan dalam Islam',
                'isi' => 'Peserta didik mampu menjelaskan pengertian ilmu faraid, sebab-sebab menerima dan terhalang warisan; mengidentifikasi ahli waris beserta bagiannya (ashabul furudh dan ashabah); melakukan perhitungan pembagian harta warisan secara matematis; serta mengaitkan ketentuan mawaris Islam dengan hukum perdata yang berlaku di Indonesia.',
                'urutan' => 2
            ],
            [
                'topik' => 'haji',
                'sub_judul' => 'CP — Haji',
                'badge_style' => 'background:linear-gradient(135deg,var(--gold),var(--gold-l));color:#1A2A3A',
                'judul' => 'Peserta didik memahami ketentuan ibadah haji dan umrah',
                'isi' => 'Peserta didik mampu menjelaskan pengertian, dalil, syarat wajib, rukun, wajib, dan sunnah haji serta umrah; mengidentifikasi hal-hal yang membatalkan haji; mendeskripsikan prosesi manasik haji secara berurutan; serta menghayati hikmah dan nilai-nilai spiritual dari pelaksanaan ibadah haji dalam kehidupan sehari-hari.',
                'urutan' => 3
            ],
        ];
        foreach ($cp as $d) AtpSection::create(array_merge(['tipe' => 'cp'], $d));

        // ── TP ──────────────────────────────────────────────
        $tp = [
            [
                'topik' => 'zakat',
                'sub_judul' => 'TP 1 — Zakat',
                'judul' => 'Menjelaskan konsep dan dalil zakat',
                'isi' => 'Peserta didik dapat menjelaskan pengertian zakat, dalil Al-Qur\'an dan Hadits tentang zakat, serta membedakan zakat fitrah dan zakat maal dengan benar.',
                'tags' => json_encode(['C1 Mengingat', 'C2 Memahami']),
                'urutan' => 1
            ],
            [
                'topik' => 'zakat',
                'sub_judul' => 'TP 2 — Zakat',
                'judul' => 'Menghitung kadar zakat maal',
                'isi' => 'Peserta didik dapat menghitung nisab dan haul berbagai jenis harta, serta menentukan kadar zakat yang wajib dikeluarkan secara tepat.',
                'tags' => json_encode(['C3 Menerapkan', 'C4 Menganalisis']),
                'urutan' => 2
            ],
            [
                'topik' => 'mawaris',
                'sub_judul' => 'TP 3 — Mawaris',
                'badge_style' => 'color:var(--gold-l)',
                'judul' => 'Mengidentifikasi ahli waris dan bagiannya',
                'isi' => 'Peserta didik dapat mengidentifikasi seluruh ahli waris, menentukan bagian masing-masing ashabul furudh, dan menjelaskan konsep ashabah.',
                'tags' => json_encode(['C1 Mengingat', 'C3 Menerapkan']),
                'urutan' => 3
            ],
            [
                'topik' => 'mawaris',
                'sub_judul' => 'TP 4 — Mawaris',
                'badge_style' => 'color:var(--gold-l)',
                'judul' => 'Menyelesaikan kasus pembagian warisan',
                'isi' => 'Peserta didik dapat melakukan perhitungan pembagian harta warisan dalam berbagai kasus, termasuk kasus radd, aul, dan gharrawain.',
                'tags' => json_encode(['C4 Menganalisis', 'C5 Mengevaluasi']),
                'urutan' => 4
            ],
            [
                'topik' => 'haji',
                'sub_judul' => 'TP 5 — Haji',
                'judul' => 'Mendeskripsikan rukun dan wajib haji',
                'isi' => 'Peserta didik dapat mendeskripsikan rukun, wajib, dan sunnah haji serta umrah secara lengkap dan membedakan dam/fidyah yang berlaku.',
                'tags' => json_encode(['C1 Mengingat', 'C2 Memahami']),
                'urutan' => 5
            ],
            [
                'topik' => 'haji',
                'sub_judul' => 'TP 6 — Haji',
                'judul' => 'Menghayati hikmah ibadah haji',
                'isi' => 'Peserta didik dapat menganalisis nilai-nilai spiritual, sosial, dan kemanusiaan dari ibadah haji serta mengimplementasikannya dalam kehidupan.',
                'tags' => json_encode(['C5 Mengevaluasi', 'C6 Mencipta']),
                'urutan' => 6
            ],
        ];
        foreach ($tp as $d) AtpSection::create(array_merge(['tipe' => 'tp'], $d));

        // ── TIMELINE ────────────────────────────────────────
        $tl = [
            [
                'topik' => 'zakat',
                'icon' => '🤲',
                'minggu' => 'Pertemuan 1–2 · Zakat',
                'judul' => 'Konsep Dasar & Dalil Zakat',
                'isi' => 'Pengenalan pengertian zakat, landasan Al-Qur\'an (QS. Al-Baqarah: 43, 110) dan Hadits, perbedaan zakat fitrah dan zakat maal, serta sejarah zakat dalam Islam.',
                'chips' => json_encode(['Tatap Muka', 'Diskusi Kelompok', '2 × 2 JP']),
                'urutan' => 1
            ],
            [
                'topik' => 'zakat',
                'icon' => '📊',
                'minggu' => 'Pertemuan 3–4 · Zakat',
                'judul' => 'Ketentuan & Perhitungan Zakat Maal',
                'isi' => 'Nisab dan haul berbagai jenis harta, kadar zakat, muzakki dan mustahiq (8 golongan), serta praktik perhitungan zakat profesi, perdagangan, dan pertanian.',
                'chips' => json_encode(['Problem Based', 'Praktik Hitung', '2 × 2 JP']),
                'urutan' => 2
            ],
            [
                'topik' => 'zakat',
                'icon' => '🏛️',
                'minggu' => 'Pertemuan 5–6 · Zakat',
                'judul' => 'Pengelolaan Zakat Modern & BAZNAS',
                'isi' => 'Lembaga amil zakat (BAZNAS, LAZ), UU No. 23 Tahun 2011 tentang pengelolaan zakat, distribusi zakat produktif, dan dampak sosial-ekonomi zakat.',
                'chips' => json_encode(['Studi Kasus', 'Presentasi', '2 × 2 JP']),
                'urutan' => 3
            ],
            [
                'topik' => 'mawaris',
                'icon' => '⚖️',
                'minggu' => 'Pertemuan 7–9 · Mawaris',
                'judul' => 'Dasar Ilmu Faraid & Ahli Waris',
                'isi' => 'Pengertian ilmu faraid, sebab-sebab mewarisi, halangan mewarisi, klasifikasi ahli waris, ashabul furudh beserta bagiannya, dan ashabah.',
                'chips' => json_encode(['Ceramah', 'Mind Mapping', '3 × 2 JP']),
                'urutan' => 4
            ],
            [
                'topik' => 'mawaris',
                'icon' => '🔢',
                'minggu' => 'Pertemuan 10–12 · Mawaris',
                'judul' => 'Perhitungan & Kasus Mawaris',
                'isi' => 'Metode pembagian warisan, asal masalah, kasus aul, radd, dan kasus khusus (musytarakah, akdariyah, gharrawain). Latihan soal bertahap dari sederhana ke kompleks.',
                'chips' => json_encode(['Drill Soal', 'Kooperatif', '3 × 2 JP']),
                'urutan' => 5
            ],
            [
                'topik' => 'haji',
                'icon' => '🕋',
                'minggu' => 'Pertemuan 13–16 · Haji',
                'judul' => 'Ketentuan & Manasik Haji',
                'isi' => 'Syarat, rukun, wajib haji, dan umrah; perbedaan haji ifrad, tamattu, dan qiran; prosesi manasik dari miqat hingga tawaf wada\'; dam/fidyah; serta video simulasi manasik.',
                'chips' => json_encode(['Simulasi', 'Media Visual', '4 × 2 JP']),
                'urutan' => 6
            ],
            [
                'topik' => 'haji',
                'icon' => '✅',
                'minggu' => 'Pertemuan 17–18 · Evaluasi',
                'judul' => 'Asesmen Sumatif & Refleksi',
                'isi' => 'Evaluasi tertulis mencakup keseluruhan materi, presentasi proyek, refleksi pembelajaran, dan penyusunan portofolio peserta didik sebagai bukti capaian belajar.',
                'chips' => json_encode(['Tes Tertulis', 'Portofolio', '2 × 2 JP']),
                'urutan' => 7
            ],
        ];
        foreach ($tl as $d) AtpSection::create(array_merge(['tipe' => 'timeline'], $d));

        // ── TOPIK ZAKAT ──────────────────────────────────────
        $topikZ = [
            ['judul' => 'Pengertian & Dalil Zakat', 'isi' => 'Definisi zakat secara bahasa dan istilah, landasan Al-Qur\'an, Hadits, dan ijma\' ulama.', 'sub_judul' => 'Pertemuan 1', 'urutan' => 1],
            ['judul' => 'Zakat Fitrah', 'isi' => 'Hukum, waktu, kadar, penerima, dan tata cara mengeluarkan zakat fitrah beserta hikmahnya.', 'sub_judul' => 'Pertemuan 2', 'urutan' => 2],
            ['judul' => 'Nisab & Haul Zakat Maal', 'isi' => 'Ketentuan nisab dan haul untuk emas, perak, hasil pertanian, binatang ternak, dan barang dagangan.', 'sub_judul' => 'Pertemuan 3', 'urutan' => 3],
            ['judul' => '8 Golongan Mustahiq', 'isi' => 'Fakir, miskin, amil, muallaf, riqab, gharim, fi sabilillah, dan ibnu sabil — definisi dan contoh kontemporer.', 'sub_judul' => 'Pertemuan 3', 'urutan' => 4],
            ['judul' => 'Zakat Profesi & Digital', 'isi' => 'Ijtihad ulama tentang zakat profesi, zakat saham, zakat deposito, dan pembayaran zakat via aplikasi digital.', 'sub_judul' => 'Pertemuan 4', 'urutan' => 5],
            ['judul' => 'BAZNAS & LAZ Modern', 'isi' => 'Kelembagaan zakat nasional, UU Pengelolaan Zakat, program zakat produktif, dan dampak sosial-ekonomi.', 'sub_judul' => 'Pertemuan 5–6', 'urutan' => 6],
        ];
        foreach ($topikZ as $d) AtpSection::create(array_merge(['tipe' => 'topik', 'topik' => 'zakat'], $d));

        // ── TOPIK MAWARIS ────────────────────────────────────
        $topikM = [
            ['judul' => 'Dasar Ilmu Faraid', 'isi' => 'Pengertian, urgensi, dalil Al-Qur\'an (QS. An-Nisa: 11–12, 176), dan sejarah perkembangan ilmu faraid.', 'sub_judul' => 'Pertemuan 7', 'badge_style' => 'background:linear-gradient(135deg,#1A3A5C,var(--navy-light))', 'urutan' => 1],
            ['judul' => 'Sebab & Penghalang Waris', 'isi' => 'Tiga sebab mewarisi (nasab, nikah, wala), dan empat penghalang waris (pembunuhan, beda agama, murtad, budak).', 'sub_judul' => 'Pertemuan 7', 'badge_style' => 'background:linear-gradient(135deg,#1A3A5C,var(--navy-light))', 'urutan' => 2],
            ['judul' => 'Ashabul Furudh', 'isi' => 'Daftar lengkap 12 ahli waris dengan bagian tetap: 1/2, 1/4, 1/8, 2/3, 1/3, 1/6 — syarat dan ketentuannya.', 'sub_judul' => 'Pertemuan 8', 'badge_style' => 'background:linear-gradient(135deg,#1A3A5C,var(--navy-light))', 'urutan' => 3],
            ['judul' => 'Ashabah', 'isi' => 'Pengertian ashabah binafsih, bilghayr, ma\'alghayr — urutan prioritas dan contoh kasus.', 'sub_judul' => 'Pertemuan 9', 'badge_style' => 'background:linear-gradient(135deg,#1A3A5C,var(--navy-light))', 'urutan' => 4],
            ['judul' => 'Asal Masalah & Perhitungan', 'isi' => 'Cara menentukan asal masalah, penyebut terkecil, dan langkah perhitungan pembagian warisan secara sistematis.', 'sub_judul' => 'Pertemuan 10', 'badge_style' => 'background:linear-gradient(135deg,#1A3A5C,var(--navy-light))', 'urutan' => 5],
            ['judul' => 'Kasus Aul, Radd & Khusus', 'isi' => 'Penyelesaian kasus aul (kurang harta), radd (lebih harta), musytarakah, akdariyah, dan gharrawain.', 'sub_judul' => 'Pertemuan 11–12', 'badge_style' => 'background:linear-gradient(135deg,#1A3A5C,var(--navy-light))', 'urutan' => 6],
        ];
        foreach ($topikM as $d) AtpSection::create(array_merge(['tipe' => 'topik', 'topik' => 'mawaris'], $d));

        // ── TOPIK HAJI ───────────────────────────────────────
        $topikH = [
            ['judul' => 'Syarat & Hukum Haji', 'isi' => 'Hukum haji (fardhu ain sekali seumur hidup), syarat wajib haji (Islam, baligh, berakal, mampu, merdeka).', 'sub_judul' => 'Pertemuan 13', 'badge_style' => 'background:linear-gradient(135deg,var(--gold),var(--gold-l));color:#1A2A3A', 'urutan' => 1],
            ['judul' => 'Rukun & Wajib Haji', 'isi' => '6 rukun haji (ihram, wukuf, tawaf ifadhah, sa\'i, tahalul, tertib) dan 7 wajib haji beserta dam yang berlaku.', 'sub_judul' => 'Pertemuan 13', 'badge_style' => 'background:linear-gradient(135deg,var(--gold),var(--gold-l));color:#1A2A3A', 'urutan' => 2],
            ['judul' => 'Macam Haji & Umrah', 'isi' => 'Perbedaan haji ifrad, tamattu, dan qiran; pengertian umrah; syarat, rukun, wajib, dan larangan dalam umrah.', 'sub_judul' => 'Pertemuan 14', 'badge_style' => 'background:linear-gradient(135deg,var(--gold),var(--gold-l));color:#1A2A3A', 'urutan' => 3],
            ['judul' => 'Prosesi Manasik Haji', 'isi' => 'Urutan lengkap manasik: miqat → ihram → tawaf qudum → sa\'i → wukuf di Arafah → mabit Muzdalifah → lontar jumrah → tahalul → tawaf ifadhah → tawaf wada\'.', 'sub_judul' => 'Pertemuan 15', 'badge_style' => 'background:linear-gradient(135deg,var(--gold),var(--gold-l));color:#1A2A3A', 'urutan' => 4],
            ['judul' => 'Dam & Fidyah', 'isi' => 'Jenis-jenis dam (menyembelih hewan), kewajiban dam akibat pelanggaran larangan ihram, dam tamattu dan qiran.', 'sub_judul' => 'Pertemuan 15', 'badge_style' => 'background:linear-gradient(135deg,var(--gold),var(--gold-l));color:#1A2A3A', 'urutan' => 5],
            ['judul' => 'Hikmah Ibadah Haji', 'isi' => 'Nilai persaudaraan Islam, kesetaraan sosial, ketaatan kepada Allah, dan implementasi nilai haji dalam kehidupan nyata.', 'sub_judul' => 'Pertemuan 16', 'badge_style' => 'background:linear-gradient(135deg,var(--gold),var(--gold-l));color:#1A2A3A', 'urutan' => 6],
        ];
        foreach ($topikH as $d) AtpSection::create(array_merge(['tipe' => 'topik', 'topik' => 'haji'], $d));

        $this->command->info('✅ AtpSection seeded: ' . AtpSection::count() . ' records.');
    }
}
