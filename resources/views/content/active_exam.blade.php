<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Exam - Fisika Terapan</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Top Navbar -->
    <nav class="bg-white fixed w-full z-50 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto px-6 py-3">
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="#" class="flex items-center space-x-2.5">
                    <div class="bg-blue-600 p-1.5 rounded-lg text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900 tracking-tight">Bank Soal</span>
                </a>

                <!-- Exam Navigation Tabs -->
                <div class="hidden md:flex items-center space-x-1 bg-gray-100 p-1 rounded-lg text-xs font-semibold">
                    <span class="bg-blue-600 text-white px-4 py-1.5 rounded-md shadow-xs">Active Exam</span>
                    <a href="#" class="text-gray-600 hover:text-gray-900 px-4 py-1.5">Candidate Portal</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900 px-4 py-1.5">Device Check</a>
                </div>
            </div>

            <!-- Profile Right -->
            <div class="flex items-center">
                <button class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="pt-24 pb-12 px-4 sm:px-6 max-w-screen-2xl mx-auto">

        <!-- Exam Sub-Header Info Bar -->
        <div
            class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs mb-6 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">SIMULASI UJIAN
                        TERJADWAL</span>
                    <h1 class="text-lg font-bold text-gray-900">Fisika Terapan - Kelas XII MIPA Semester Ganjil</h1>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto justify-end">
                <!-- Sisa Waktu Badge -->
                <div
                    class="flex items-center space-x-2 bg-gray-50 border border-gray-200 px-3 py-2 rounded-lg text-xs font-semibold text-gray-700">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Sisa Waktu: <strong class="text-red-600 font-mono">01:24:17</strong></span>
                </div>

                <!-- User Candidate Badge -->
                <div
                    class="flex items-center space-x-2 bg-gray-50 border border-gray-200 px-3 py-2 rounded-lg text-xs font-semibold text-gray-700">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    <span>Ahmad Fauzi (XII MIPA 1)</span>
                </div>

                <!-- Selesaikan Ujian Button -->
                <button
                    class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 text-xs font-semibold px-4 py-2 rounded-lg flex items-center transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Selesaikan Ujian
                </button>
            </div>
        </div>

        <!-- Layout Grid: Left Question Section, Right Navigation Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            <!-- Left 2 Columns: Soal & Options -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Question Card -->
                <div class="bg-white p-6 sm:p-8 rounded-xl border border-gray-200 shadow-xs relative">
                    <!-- Question Meta Tag -->
                    <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                        <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-lg">Soal No. 14</span>
                        <div class="flex items-center space-x-3 text-xs text-gray-500">
                            <span>dari 30 butir</span>
                            <span>•</span>
                            <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded font-medium">Bobot: 4 Poin</span>
                            <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded font-medium">Pilihan Ganda</span>
                        </div>
                    </div>

                    <!-- Question Text -->
                    <p class="text-sm sm:text-base text-gray-900 leading-relaxed mb-6 font-medium">
                        Sebuah benda bermassa 2 kg dilepaskan tanpa kecepatan awal dari puncak bidang miring licin yang
                        memiliki sudut kemiringan $30^\circ$ terhadap bidang horizontal. Jika percepatan gravitasi bumi
                        dianggap $g = 10\text{ m/s}^2$ dan panjang lintasan bidang miring tersebut adalah 10 meter,
                        berapakah kecepatan sesaat benda ketika mencapai dasar bidang miring?
                    </p>

                    <!-- Image / Formula Box Context -->
                    <div
                        class="bg-gray-50 border border-gray-200 rounded-xl p-5 mb-6 flex flex-col md:flex-row items-center gap-6">
                        <div
                            class="w-full md:w-1/2 flex justify-center bg-white p-4 rounded-lg border border-gray-100 shadow-2xs">
                            <svg class="w-48 h-32 text-gray-700" viewBox="0 0 200 120" fill="none"
                                stroke="currentColor">
                                <!-- Triangle incline -->
                                <path stroke-width="2" d="M20 100 L180 100 L180 40 Z" />
                                <!-- Angle arc -->
                                <path stroke-width="1.5" d="M 45 100 A 25 25 0 0 0 35 90" />
                                <text x="50" y="92" font-size="10" fill="currentColor">$\theta = 30^\circ$</text>
                                <!-- Box on incline -->
                                <rect x="80" y="55" width="22" height="15" rx="2"
                                    transform="rotate(-30 80 55)" fill="#3b82f6" stroke="#1d4ed8" stroke-width="1.5" />
                                <!-- Mass label -->
                                <text x="95" y="45" font-size="10" fill="currentColor">$m = 2\text{ kg}$</text>
                                <!-- Length label s = 10m -->
                                <text x="110" y="75" font-size="10" fill="currentColor">$s = 10\text{ m}$</text>
                            </svg>
                        </div>
                        <div class="w-full md:w-1/2 space-y-2">
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">FORMULASI
                                KINEMATIKA TERKAIT</div>
                            <div
                                class="bg-white border border-gray-200 p-3 rounded-lg font-mono text-xs text-blue-600 font-bold shadow-2xs">
                                $$v^2 = v_o^2 + 2 \cdot g \cdot s \cdot \sin(\theta)$$
                            </div>
                            <p class="text-[11px] text-gray-500 italic">Catatan: Abaikan gaya gesek udara dan gesekan
                                permukaan miring.</p>
                        </div>
                    </div>

                    <!-- Multiple Choice Options -->
                    <div class="space-y-3">
                        <!-- Option A -->
                        <label
                            class="flex items-center p-4 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer transition-all">
                            <input type="radio" name="jawaban"
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-xs font-bold text-gray-400 mr-4">A</span>
                            <span class="text-sm font-medium text-gray-900">$10\text{ m/s}$</span>
                        </label>

                        <!-- Option B (Selected) -->
                        <label
                            class="flex items-center p-4 rounded-xl border-2 border-blue-600 bg-blue-50/50 cursor-pointer transition-all">
                            <input type="radio" name="jawaban" checked
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-xs font-bold text-blue-600 mr-4">B</span>
                            <span class="text-sm font-bold text-blue-900">$10\sqrt{2}\text{ m/s}$</span>
                        </label>

                        <!-- Option C -->
                        <label
                            class="flex items-center p-4 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer transition-all">
                            <input type="radio" name="jawaban"
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-xs font-bold text-gray-400 mr-4">C</span>
                            <span class="text-sm font-medium text-gray-900">$14.1\text{ m/s}$</span>
                        </label>

                        <!-- Option D -->
                        <label
                            class="flex items-center p-4 rounded-xl border border-gray-200 hover:bg-gray-50 cursor-pointer transition-all">
                            <input type="radio" name="jawaban"
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-3 text-xs font-bold text-gray-400 mr-4">D</span>
                            <span class="text-sm font-medium text-gray-900">$20\text{ m/s}$</span>
                        </label>
                    </div>
                </div>

                <!-- Bottom Navigation Buttons -->
                <div class="flex items-center justify-between gap-4">
                    <button
                        class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 text-xs font-semibold px-5 py-3 rounded-xl flex items-center shadow-xs transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        Soal Sebelumnya
                    </button>
                    <button
                        class="bg-amber-100 hover:bg-amber-200 text-amber-800 border border-amber-300 text-xs font-semibold px-5 py-3 rounded-xl flex items-center shadow-xs transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round5" stroke-width="2"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        Ragu-ragu (Tandai Soal)
                    </button>
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-6 py-3 rounded-xl flex items-center shadow-xs transition-colors">
                        Soal Berikutnya
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Column: Question Navigator Sidebar & Security Notice -->
            <div class="space-y-6">
                <!-- Navigasi Nomor Soal Card -->
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-900">Navigasi Nomor Soal</h3>
                        <span class="text-xs font-bold text-blue-600">14 / 30</span>
                    </div>

                    <!-- Legend Status -->
                    <div class="grid grid-cols-3 gap-2 mb-4 text-[10px] font-semibold text-gray-600">
                        <div class="flex items-center space-x-1.5">
                            <span class="w-3 h-3 bg-blue-600 rounded-xs inline-block"></span>
                            <span>Terjawab</span>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <span class="w-3 h-3 bg-amber-200 rounded-xs inline-block"></span>
                            <span>Ragu-ragu</span>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <span class="w-3 h-3 bg-gray-100 border border-gray-300 rounded-xs inline-block"></span>
                            <span>Kosong</span>
                        </div>
                    </div>

                    <!-- Number Grid (30 Items) -->
                    <div class="grid grid-cols-5 gap-2 mb-6">
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">01</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">02</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">03</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">04</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">05</button>

                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">06</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">07</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">08</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">09</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">10</button>

                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">11</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">12</button>
                        <button class="h-9 rounded-lg font-bold text-xs bg-blue-600 text-white shadow-2xs">13</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs ring-2 ring-blue-800 bg-blue-600 text-white shadow-md">14</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-amber-200 text-amber-900 border border-amber-300 shadow-2xs">15</button>

                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">16</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">17</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">18</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">19</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">20</button>

                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">21</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">22</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">23</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">24</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">25</button>

                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">26</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">27</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">28</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">29</button>
                        <button
                            class="h-9 rounded-lg font-bold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-200">30</button>
                    </div>

                    <!-- Review & Kumpulkan Button -->
                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs py-3 rounded-xl flex items-center justify-center space-x-2 shadow-xs transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        <span>Review & Kumpulkan</span>
                    </button>
                </div>

                <!-- Integrity Browser Active Card -->
                <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl flex items-start space-x-3">
                    <div class="text-emerald-600 mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-emerald-900">Integritas Browser Aktif</div>
                        <p class="text-[11px] text-emerald-700 mt-0.5 leading-relaxed">Aktivitas tab browser dan
                            peralihan jendela terpantau otomatis oleh sistem pengawas virtual.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer Copyright -->
    <footer class="border-t border-gray-200 bg-white py-6 text-center text-xs text-gray-500">
        <div class="max-w-screen-2xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>&copy; 2026 Bank Soal Examination Systems. Institutional Grade Assessment.</div>
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:underline">Integrity Policy</a>
                <span>•</span>
                <a href="#" class="hover:underline">Technical Support</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>
