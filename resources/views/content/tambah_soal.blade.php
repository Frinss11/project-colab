<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Top Navbar -->
    <nav class="bg-white fixed w-full z-50 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto px-6 py-3">
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5">
                    <div class="bg-blue-600 p-1.5 rounded-lg text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900 tracking-tight">Bank Soal</span>
                </a>
            </div>
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
    <main class="pt-24 pb-12 px-4 sm:px-6 max-w-4xl mx-auto space-y-6">

        @if (session('success'))
            <div class="p-4 text-xs text-green-800 rounded-xl bg-green-50 border border-green-200" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 text-xs text-red-800 rounded-xl bg-red-50 border border-red-200" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 text-xs text-red-800 rounded-xl bg-red-50 border border-red-200" role="alert">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">PANEL
                    ADMINISTRATOR</span>
                <h1 class="text-xl font-bold text-gray-900">Form Input Soal Baru</h1>
                @if (isset($package) && $package)
                    <p class="text-xs text-blue-600 mt-1">Menambahkan soal ke package: {{ $package->nama_package }}</p>
                @endif
            </div>
            <a href="{{ route('package.show', $package->id) }}" class="text-xs font-semibold text-blue-600 hover:underline flex items-center">
                &larr; Kembali ke Daftar Soal
            </a>
        </div>

        <!-- Tab Navigasi 3 Metode -->
        <div class="mb-4 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-xs font-medium text-center" id="soalTab"
                data-tabs-toggle="#soalTabContent" role="tablist">
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg aria-selected:border-blue-600 aria-selected:text-blue-600 hover:text-gray-600 hover:border-gray-300"
                        id="manual-tab" data-tabs-target="#manual" type="button" role="tab" aria-selected="true">
                        ✍️ Buat Sendiri (Manual)
                    </button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg aria-selected:border-blue-600 aria-selected:text-blue-600 hover:text-gray-600 hover:border-gray-300"
                        id="ai-tab" data-tabs-target="#ai" type="button" role="tab" aria-selected="false">
                        ✨ Generate dari AI
                    </button>
                </li>
                <li role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg aria-selected:border-blue-600 aria-selected:text-blue-600 hover:text-gray-600 hover:border-gray-300"
                        id="import-tab" data-tabs-target="#import" type="button" role="tab" aria-selected="false">
                        📁 Convert Excel / Word
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div id="soalTabContent">

            <!-- 1. METODE: BUAT SENDIRI (MANUAL) -->
            <div class="hidden bg-white p-6 sm:p-8 rounded-xl border border-gray-200 shadow-xs space-y-6" id="manual"
                role="tabpanel" aria-labelledby="manual-tab">
                <form action="{{ route('soal.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if (isset($package) && $package)
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                    @endif

                    <!-- Pertanyaan -->
                    <div>
                        <label for="pertanyaan"
                            class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-wider">Pertanyaan /
                            Soal (`pertanyaan`)</label>
                        <textarea id="pertanyaan" name="pertanyaan" rows="4" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                            placeholder="Tuliskan teks soal di sini..."></textarea>
                    </div>

                    <hr class="border-gray-100 my-4">

                    <!-- Pilihan Ganda (pilihan_a s.d pilihan_e) -->
                    <div class="space-y-4">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Opsi Pilihan
                            Ganda</label>

                        <div class="flex items-center space-x-3">
                            <span
                                class="w-8 h-10 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-lg text-xs">A</span>
                            <input type="text" name="pilihan_a" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5"
                                placeholder="Pilihan A">
                        </div>

                        <div class="flex items-center space-x-3">
                            <span
                                class="w-8 h-10 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-lg text-xs">B</span>
                            <input type="text" name="pilihan_b" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5"
                                placeholder="Pilihan B">
                        </div>

                        <div class="flex items-center space-x-3">
                            <span
                                class="w-8 h-10 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-lg text-xs">C</span>
                            <input type="text" name="pilihan_c" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5"
                                placeholder="Pilihan C">
                        </div>

                        <div class="flex items-center space-x-3">
                            <span
                                class="w-8 h-10 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-lg text-xs">D</span>
                            <input type="text" name="pilihan_d" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5"
                                placeholder="Pilihan D">
                        </div>

                        <div class="flex items-center space-x-3">
                            <span
                                class="w-8 h-10 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-lg text-xs">E</span>
                            <input type="text" name="pilihan_e" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-2.5"
                                placeholder="Pilihan E">
                        </div>
                    </div>

                    <hr class="border-gray-100 my-4">

                    <!-- Kunci Jawaban -->
                    <div>
                        <label for="jawaban"
                            class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-wider">Kunci Jawaban
                            (`jawaban`)</label>
                        <select id="jawaban" name="jawaban" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-3">
                            <option value="" disabled selected>Pilih kunci jawaban yang benar</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 flex items-center justify-end space-x-4">
                        <button type="reset"
                            class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 text-xs font-semibold px-5 py-3 rounded-xl transition-colors">
                            Reset Form
                        </button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs px-6 py-3 rounded-xl shadow-xs transition-colors">
                            Simpan Soal
                        </button>
                    </div>
                </form>
            </div>

            <!-- 2. METODE: GENERATE DARI AI -->
            <div class="hidden bg-white p-6 sm:p-8 rounded-xl border border-gray-200 shadow-xs space-y-6"
                id="ai" role="tabpanel" aria-labelledby="ai-tab">
                <form action="{{ route('soal.generate-ai') }}" method="POST" class="space-y-4">
                    @csrf
                    @if (isset($package) && $package)
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                    @endif
                    <div
                        class="p-4 mb-4 text-xs text-blue-800 rounded-xl bg-blue-50 border border-blue-200 flex items-center space-x-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>AI akan membuatkan soal dan langsung menyimpannya ke struktur tabel `soal` berdasarkan
                            topik yang Anda tuliskan.</span>
                    </div>

                    <div>
                        <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-wider">Topik /
                            Materi Pembelajaran</label>
                        <input type="text" name="topik_ai" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-3"
                            placeholder="Contoh: Sistem Pencernaan Manusia">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-wider">Jumlah
                                Soal</label>
                            <input type="number" name="jumlah_ai" min="1" max="10" value="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-3">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-wider">Tingkat
                                Kesulitan</label>
                            <select name="kesulitan_ai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl block w-full p-3">
                                <option value="mudah">Mudah</option>
                                <option value="sedang" selected>Sedang</option>
                                <option value="sulit">Sulit</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white font-semibold text-xs px-6 py-3 rounded-xl shadow-xs transition-colors flex items-center space-x-2">
                            <span>✨ Generate & Simpan ke Database</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- 3. METODE: CONVERT EXCEL / WORD -->
            <div class="hidden bg-white p-6 sm:p-8 rounded-xl border border-gray-200 shadow-xs space-y-6"
                id="import" role="tabpanel" aria-labelledby="import-tab">
                <form action="{{ route('soal.import') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @if (isset($package) && $package)
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                    @endif
                    <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <div>
                            <h4 class="text-xs font-bold text-gray-800 uppercase">Template Dokumen Sesuai Kolom
                                Database</h4>
                            <p class="text-[11px] text-gray-500">Header yang diterima: pertanyaan, pilihan_a sampai
                                pilihan_e, jawaban. Format Soal, Jawaban a sampai Jawaban e, dan jawaban benar juga didukung.</p>
                        </div>
                        <div>
                            <a href="#"
                                class="px-3 py-1.5 text-xs font-semibold text-green-700 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100">Download
                                Template</a>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-wider">Unggah File
                            (.xlsx / .docx)</label>
                        <input type="file" name="file_soal" accept=".xlsx, .xls, .docx" required
                            class="block w-full text-xs text-gray-900 border border-gray-300 rounded-xl cursor-pointer bg-gray-50 focus:outline-none p-2.5">
                        <p class="mt-1 text-[10px] text-gray-500">Sistem akan melakukan parsing otomatis dan
                            memasukkannya ke tabel `soal`.</p>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs px-6 py-3 rounded-xl shadow-xs transition-colors">
                            📁 Upload & Convert File
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-white py-6 text-center text-xs text-gray-500">
        <div class="max-w-screen-2xl mx-auto px-6">&copy; 2026 Bank Soal Examination Systems. Institutional Grade
            Assessment.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>
