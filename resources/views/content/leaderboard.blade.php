<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard & Peringkat Siswa</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 font-sans text-slate-800">

    <!-- Header / Navbar -->
    <header class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="bg-blue-600 text-white p-2 rounded-lg font-bold">BS</div>
            <div>
                <h1 class="font-bold text-lg text-slate-900 leading-tight">Bank Soal</h1>
                <span class="text-xs text-slate-500">Clarion Engine</span>
            </div>
        </div>
        <nav class="hidden md:flex space-x-6 text-sm font-medium text-slate-600">
            <a href="#" class="hover:text-blue-600">Beranda</a>
            <a href="#" class="hover:text-blue-600">Bank Soal & Latihan</a>
            <a href="#" class="hover:text-blue-600">Ujian CBT</a>
            <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-1">Leaderboard</a>
            <a href="#" class="hover:text-blue-600">Riwayat Nilai</a>
        </nav>
        <div class="flex items-center space-x-4">
            <span class="text-xs bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-full font-medium">● CBT SVR-01:
                ONLINE</span>
            <span class="text-sm font-semibold">Ahmad Fauzi <span class="text-xs font-normal text-slate-500">XII MIPA
                    1</span></span>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

        <!-- Breadcrumb & Title -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <div class="flex items-center space-x-2 text-xs text-blue-600 font-semibold mb-1">
                    <span>TAHUN AJARAN 2024/2025</span>
                    <span>•</span>
                    <span class="text-emerald-600">Sinkronisasi Live</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Leaderboard & Peringkat Siswa</h2>
                <p class="text-sm text-slate-500 mt-1">Peringkat akademik dan performa latihan terverifikasi otomatis
                    secara real-time.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <div class="bg-white border border-slate-200 px-4 py-2 rounded-lg shadow-sm text-sm">
                    <span class="text-slate-500 text-xs block">Ujian</span>
                    <span class="font-semibold text-slate-800">PAS Ganjil 2024/2025 - Fisika Terapan</span>
                </div>
                <div class="bg-white border border-slate-200 px-4 py-2 rounded-lg shadow-sm text-sm">
                    <span class="text-slate-500 text-xs block">Kelas</span>
                    <span class="font-semibold text-slate-800">XII MIPA 1 (36 Siswa)</span>
                </div>
                <div
                    class="bg-blue-50 border border-blue-200 px-4 py-2 rounded-lg text-sm text-blue-800 font-medium flex items-center">
                    <span>⚡ KKM: 75</span>
                </div>
            </div>
        </div>

        <!-- Tab Navigasi Kecil -->
        <div class="flex space-x-2 border-b border-slate-200 mb-8 overflow-x-auto">
            <button
                class="px-4 py-2 border-b-2 border-blue-600 text-blue-600 font-semibold text-sm whitespace-nowrap">Nilai
                Ujian</button>
            <button class="px-4 py-2 text-slate-500 hover:text-slate-800 font-medium text-sm whitespace-nowrap">Akurasi
                Jawaban</button>
            <button class="px-4 py-2 text-slate-500 hover:text-slate-800 font-medium text-sm whitespace-nowrap">Poin
                Latihan Mandiri</button>
            <button
                class="px-4 py-2 text-slate-500 hover:text-slate-800 font-medium text-sm whitespace-nowrap">Rata-rata
                Semester</button>
        </div>

        <!-- Kartu Statistik Kamu -->
        <div
            class="bg-gradient-to-r from-blue-700 to-blue-900 rounded-2xl text-white p-6 md:p-8 shadow-xl mb-12 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div class="flex items-center space-x-4">
                <div
                    class="w-16 h-16 bg-blue-600 border-2 border-white rounded-2xl flex items-center justify-center text-2xl font-bold shadow-inner">
                    AF
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <h3 class="text-xl font-bold">Ahmad Fauzi (Kamu)</h3>
                        <span class="bg-emerald-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Tuntas
                            KKM</span>
                    </div>
                    <p class="text-xs text-blue-200 mt-1">NISN: 0864821982 • Kelas XII MIPA 1</p>
                    <p class="text-xs text-yellow-300 font-medium mt-2 flex items-center gap-1">
                        <span>💡</span> Hanya selisih 6 poin dari posisi teratas (Nadia Safitri - 98 Poin). Pertahankan
                        prestasimu!
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 w-full lg:w-auto">
                <div class="bg-white/10 backdrop-blur-md px-5 py-3 rounded-xl border border-white/10 text-center">
                    <span class="text-xs text-blue-200 block">PERINGKAT KAMU</span>
                    <span class="text-2xl font-black text-yellow-400">#2</span>
                    <span class="text-[10px] text-blue-200 block">/ 36 Siswa</span>
                </div>
                <div class="bg-white/10 backdrop-blur-md px-5 py-3 rounded-xl border border-white/10 text-center">
                    <span class="text-xs text-blue-200 block">NILAI AKHIR</span>
                    <span class="text-2xl font-black">92</span>
                    <span class="text-[10px] text-blue-200 block">/ 100</span>
                </div>
                <div class="bg-white/10 backdrop-blur-md px-5 py-3 rounded-xl border border-white/10 text-center">
                    <span class="text-xs text-blue-200 block">AKURASI</span>
                    <span class="text-2xl font-black text-emerald-400">92%</span>
                </div>
                <div class="bg-white/10 backdrop-blur-md px-5 py-3 rounded-xl border border-white/10 text-center">
                    <span class="text-xs text-blue-200 block">DURASI</span>
                    <span class="text-lg font-black mt-1 block">58m 10s</span>
                </div>
            </div>
        </div>

        <!-- Podium Kehormatan Top 3 -->
        <div class="mb-12">
            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                <span>🏆</span> Podium Kehormatan <span class="text-xs font-normal text-slate-500 ml-auto">TOP 3 KELAS
                    XII MIPA 1</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">

                <!-- Juara 2 (Ahmad Fauzi) -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-md border border-slate-100 text-center relative order-2 md:order-1">
                    <div
                        class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-slate-200 text-slate-700 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shadow">
                        2</div>
                    <div
                        class="w-14 h-14 bg-blue-600 text-white rounded-xl mx-auto flex items-center justify-center font-bold text-lg mb-3 shadow-md">
                        AF</div>
                    <h4 class="font-bold text-slate-900">Ahmad Fauzi</h4>
                    <span
                        class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-semibold inline-block mt-1">Kamu</span>
                    <p class="text-xs text-slate-400 mt-1">NISN: 0864821982</p>
                    <div class="grid grid-cols-3 gap-2 mt-4 pt-4 border-t border-slate-100 text-xs">
                        <div><span class="text-slate-400 block">Skor</span><span
                                class="font-bold text-base text-slate-800">92</span></div>
                        <div><span class="text-slate-400 block">Akurasi</span><span
                                class="font-bold text-base text-emerald-600">92%</span></div>
                        <div><span class="text-slate-400 block">Waktu</span><span
                                class="font-bold text-base text-slate-800">58m</span></div>
                    </div>
                    <div class="mt-4 bg-slate-100 text-slate-600 py-1.5 rounded-lg text-xs font-semibold">Peringkat #2
                        Kelas</div>
                </div>

                <!-- Juara 1 (Nadia Safitri) -->
                <div
                    class="bg-white rounded-2xl p-6 shadow-xl border-2 border-yellow-400 text-center relative order-1 md:order-2 transform md:-translate-y-4">
                    <div
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-yellow-500 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-base shadow-lg">
                        👑 1</div>
                    <div
                        class="w-16 h-16 bg-orange-600 text-white rounded-xl mx-auto flex items-center justify-center font-bold text-xl mb-3 shadow-md">
                        NS</div>
                    <h4 class="font-bold text-slate-900 text-lg">Nadia Safitri</h4>
                    <span
                        class="text-xs bg-yellow-100 text-yellow-800 px-2.5 py-0.5 rounded-full font-semibold inline-block mt-1">Juara
                        1 Kelas • Terbaik #1</span>
                    <p class="text-xs text-slate-400 mt-1">NISN: 0864821801</p>
                    <div class="grid grid-cols-3 gap-2 mt-4 pt-4 border-t border-slate-100 text-xs">
                        <div><span class="text-slate-400 block">Skor</span><span
                                class="font-bold text-lg text-slate-900">98</span></div>
                        <div><span class="text-slate-400 block">Akurasi</span><span
                                class="font-bold text-lg text-emerald-600">96%</span></div>
                        <div><span class="text-slate-400 block">Waktu</span><span
                                class="font-bold text-lg text-slate-900">51m</span></div>
                    </div>
                    <div
                        class="mt-4 bg-orange-50 text-orange-700 py-2 rounded-lg text-xs font-semibold border border-orange-200">
                        Tuntas dengan Nilai Sempurna</div>
                </div>

                <!-- Juara 3 (Zahra Putri) -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-slate-100 text-center relative order-3">
                    <div
                        class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-slate-200 text-slate-700 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shadow">
                        3</div>
                    <div
                        class="w-14 h-14 bg-slate-400 text-white rounded-xl mx-auto flex items-center justify-center font-bold text-lg mb-3 shadow-md">
                        ZP</div>
                    <h4 class="font-bold text-slate-900">Zahra Putri</h4>
                    <span class="text-xs text-slate-500 font-medium inline-block mt-1">Peringkat #3</span>
                    <p class="text-xs text-slate-400 mt-1">NISN: 0864821755</p>
                    <div class="grid grid-cols-3 gap-2 mt-4 pt-4 border-t border-slate-100 text-xs">
                        <div><span class="text-slate-400 block">Skor</span><span
                                class="font-bold text-base text-slate-800">90</span></div>
                        <div><span class="text-slate-400 block">Akurasi</span><span
                                class="font-bold text-base text-emerald-600">88%</span></div>
                        <div><span class="text-slate-400 block">Waktu</span><span
                                class="font-bold text-base text-slate-800">53m</span></div>
                    </div>
                    <div class="mt-4 bg-slate-100 text-slate-600 py-1.5 rounded-lg text-xs font-semibold">Peringkat #3
                        Kelas</div>
                </div>

            </div>
        </div>

        <!-- Tabel Peringkat Lengkap & Pencarian -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-12">

            <!-- Filter Bar -->
            <div
                class="p-4 sm:p-6 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="relative w-full sm:w-80">
                    <input type="text" placeholder="Cari nama teman sekelas atau NISN..."
                        class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="absolute left-3 top-2.5 text-slate-400">🔍</span>
                </div>
                <div
                    class="flex items-center space-x-2 text-xs font-medium text-slate-600 w-full sm:w-auto overflow-x-auto">
                    <span>Tampilkan:</span>
                    <button class="bg-blue-600 text-white px-3 py-1.5 rounded-lg shadow-sm">Semua (36)</button>
                    <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg">Tuntas KKM (34)</button>
                    <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg">Remedial (2)</button>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 text-slate-400 text-xs uppercase tracking-wider border-b border-slate-200">
                            <th class="py-3 px-6">Peringkat</th>
                            <th class="py-3 px-6">Nama Siswa & NISN</th>
                            <th class="py-3 px-6">Status KKM</th>
                            <th class="py-3 px-6">Waktu Pengerjaan</th>
                            <th class="py-3 px-6">Akurasi</th>
                            <th class="py-3 px-6">Skor Akhir</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <!-- Baris 1 -->
                        <tr class="hover:bg-slate-50">
                            <td class="py-4 px-6 font-bold text-slate-700">🏆 #1</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-9 h-9 bg-orange-600 text-white rounded-lg flex items-center justify-center font-bold text-xs">
                                        NS</div>
                                    <div>
                                        <div class="font-semibold text-slate-900">Nadia Safitri</div>
                                        <div class="text-xs text-slate-400">NISN: 0864821801</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span
                                    class="bg-emerald-100 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-medium">●
                                    Tuntas KKM</span></td>
                            <td class="py-4 px-6 text-slate-600">51m 12s</td>
                            <td class="py-4 px-6 font-semibold text-emerald-600">96%</td>
                            <td class="py-4 px-6 font-bold text-slate-900 text-base">98</td>
                            <td class="py-4 px-6 text-center text-slate-400">⚙️</td>
                        </tr>
                        <!-- Baris 2 (Kamu) -->
                        <tr class="bg-blue-50/50 hover:bg-blue-50">
                            <td class="py-4 px-6 font-bold text-blue-600">★ #2</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-9 h-9 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-xs">
                                        AF</div>
                                    <div>
                                        <div class="font-semibold text-slate-900 flex items-center gap-2">Ahmad Fauzi
                                            <span
                                                class="bg-blue-600 text-white text-[10px] px-1.5 py-0.5 rounded">Kamu</span>
                                        </div>
                                        <div class="text-xs text-slate-400">NISN: 0864821982</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span
                                    class="bg-emerald-100 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-medium">●
                                    Tuntas KKM</span></td>
                            <td class="py-4 px-6 text-slate-600">58m 10s</td>
                            <td class="py-4 px-6 font-semibold text-emerald-600">92%</td>
                            <td class="py-4 px-6 font-bold text-blue-700 text-base">92</td>
                            <td class="py-4 px-6 text-center"><a href="#"
                                    class="text-blue-600 text-xs font-semibold hover:underline">Detail Kamu</a></td>
                        </tr>
                        <!-- Baris 3 -->
                        <tr class="hover:bg-slate-50">
                            <td class="py-4 px-6 font-bold text-slate-700">#3</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-9 h-9 bg-slate-400 text-white rounded-lg flex items-center justify-center font-bold text-xs">
                                        ZP</div>
                                    <div>
                                        <div class="font-semibold text-slate-900">Zahra Putri</div>
                                        <div class="text-xs text-slate-400">NISN: 0864821755</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span
                                    class="bg-emerald-100 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-medium">●
                                    Tuntas KKM</span></td>
                            <td class="py-4 px-6 text-slate-600">53m 44s</td>
                            <td class="py-4 px-6 font-semibold text-emerald-600">88%</td>
                            <td class="py-4 px-6 font-bold text-slate-900 text-base">90</td>
                            <td class="py-4 px-6 text-center text-slate-400">⚙️</td>
                        </tr>
                        <!-- Baris 7 (Contoh Remedial) -->
                        <tr class="hover:bg-slate-50">
                            <td class="py-4 px-6 font-bold text-slate-700">#7</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-9 h-9 bg-purple-600 text-white rounded-lg flex items-center justify-center font-bold text-xs">
                                        DP</div>
                                    <div>
                                        <div class="font-semibold text-slate-900">Dimas Pratama</div>
                                        <div class="text-xs text-slate-400">NISN: 0864821503</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span
                                    class="bg-rose-100 text-rose-700 text-xs px-2.5 py-1 rounded-full font-medium">●
                                    Remedial (-)</span></td>
                            <td class="py-4 px-6 text-slate-600">75m 48s</td>
                            <td class="py-4 px-6 font-semibold text-slate-600">70%</td>
                            <td class="py-4 px-6 font-bold text-rose-600 text-base">72</td>
                            <td class="py-4 px-6 text-center text-slate-400">⚙️</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Tabel & Paginasi -->
            <div
                class="p-4 sm:p-6 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <span>Menampilkan 1-8 dari 36 siswa • Rata-rata Kelas: <strong class="text-slate-700">82.4 /
                        100</strong> • Ketuntasan: <strong class="text-emerald-600">94.4% (34/36)</strong></span>
                <div class="flex space-x-1">
                    <button
                        class="px-3 py-1 bg-white border border-slate-200 rounded text-slate-400 cursor-not-allowed">⟨</button>
                    <button class="px-3 py-1 bg-blue-600 text-white font-bold rounded">1</button>
                    <button class="px-3 py-1 bg-white border border-slate-200 rounded hover:bg-slate-100">2</button>
                    <button class="px-3 py-1 bg-white border border-slate-200 rounded hover:bg-slate-100">3</button>
                    <button class="px-3 py-1 bg-white border border-slate-200 rounded hover:bg-slate-100">4</button>
                    <button class="px-3 py-1 bg-white border border-slate-200 rounded hover:bg-slate-100">⟩</button>
                </div>
            </div>

        </div>

        <!-- Bagian Bawah: Distribusi, Komparasi, & Catatan Guru -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">

            <!-- Distribusi Skor Kelas -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                <h4 class="font-bold text-slate-900 text-sm mb-1">Distribusi Skor Kelas</h4>
                <p class="text-xs text-slate-400 mb-4">Sebaran nilai 36 peserta ujian XII MIPA 1</p>
                <div class="h-32 flex items-end justify-around border-b border-slate-200 pb-2 px-2 gap-2">
                    <div class="w-full bg-rose-600 h-4 rounded-t"></div>
                    <div class="w-full bg-slate-200 h-10 rounded-t"></div>
                    <div class="w-full bg-blue-600 h-28 rounded-t"></div>
                    <div class="w-full bg-emerald-700 h-20 rounded-t"></div>
                </div>
                <div class="flex justify-between text-[10px] text-slate-400 mt-2 px-2">
                    <span>
                        <75< /span>
                            <span>75-79</span>
                            <span>80-89</span>
                            <span>90-100</span>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 text-xs">
                    <span class="text-slate-400">Modus Nilai Terbanyak:</span>
                    <span class="font-bold text-slate-800 block">Rentang 80 - 89 (50%)</span>
                </div>
            </div>

            <!-- Komparasi Personal -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                <h4 class="font-bold text-slate-900 text-sm mb-1">Komparasi Personal</h4>
                <p class="text-xs text-slate-400 mb-4">Performa Anda dibanding rata-rata kelas</p>

                <div class="space-y-4 text-xs">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-slate-600">Skor Kamu (92) vs Rata-rata (82.4)</span>
                            <span class="text-emerald-600 font-bold">+9.6 Poin</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-blue-600 h-full w-4/5"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-slate-600">Durasi Kamu (58m) vs Rata-rata (66m)</span>
                            <span class="text-emerald-600 font-bold">8 Menit Lebih Cepat</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full w-2/3"></div>
                        </div>
                    </div>
                </div>

                <div
                    class="mt-6 bg-emerald-50 text-emerald-800 p-3 rounded-xl text-xs font-medium flex items-center gap-2">
                    <span>✅</span> Performa di atas rata-rata 94% siswa
                </div>
            </div>

            <!-- Catatan Guru Mata Pelajaran -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Catatan Guru Mata Pelajaran</h4>
                    <p class="text-xs text-slate-400 mb-4">Drs. Hendrawan, M.Pd • Fisika Terapan</p>
                    <blockquote
                        class="text-xs italic text-slate-600 bg-slate-50 p-4 rounded-xl border-l-4 border-blue-600 leading-relaxed">
                        "Sebagian besar siswa berhasil menguasai topik Dinamika Rotasi dengan sangat baik. Remedial
                        terjadwal Senin depan untuk 2 peserta."
                    </blockquote>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center text-xs">
                    <span class="text-slate-400">Jadwal Remedial: 23 Des 2024</span>
                    <a href="#" class="text-blue-600 font-semibold hover:underline">Unduh Rekap PDF</a>
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer
        class="bg-white border-t border-slate-200 py-6 px-4 text-center text-xs text-slate-400 flex flex-col sm:flex-row justify-between max-w-7xl mx-auto items-center gap-4">
        <div>
            <span>Clarion Assessment Engine</span> • <span class="text-slate-500">Terintegrasi Dapodik
                Kemendikbudristek RI</span>
        </div>
        <div class="flex space-x-4">
            <a href="#" class="hover:underline">Kebijakan Privasi</a>
            <a href="#" class="hover:underline">Pusat Bantuan & Dukungan</a>
            <span>© 2024 Bank Soal Kemdikbud</span>
        </div>
    </footer>

</body>

</html>
