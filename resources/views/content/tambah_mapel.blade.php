<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Soal - Tambah Mata Pelajaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="fixed inset-x-0 top-0 z-50 hidden border-b border-gray-200 bg-white sm:block">
        <div class="mx-auto flex max-w-screen-2xl flex-wrap items-center justify-between px-4 py-2.5">
            <div class="flex items-center space-x-8">
                <a href="#" class="flex items-center space-x-2.5">
                    <div class="bg-blue-600 p-1.5 rounded-lg text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-lg font-bold text-gray-900 tracking-tight block leading-none">Bank Soal</span>
                        <span class="text-[10px] font-semibold text-gray-400 tracking-wider uppercase">ADMIN
                            PORTAL</span>
                    </div>
                </a>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-bold text-gray-900">{{ auth()->user()?->name ?? 'Pengguna' }}</div>
                        <div class="text-xs text-gray-500">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}</div>
                    </div>
                    <div
                        class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold text-sm shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-white border-r border-gray-200 flex flex-col justify-between"
        aria-label="Sidebar">
        <div class="h-full px-4 py-6 overflow-y-auto">
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-4 px-3">NAVIGASI UTAMA</div>
            <ul class="space-y-1.5 font-medium text-sm">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-100 rounded-lg group">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-600" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('inventory') }}"
                        class="flex items-center px-3 py-2.5 text-blue-700 bg-blue-50 rounded-lg group">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Inventory Soal
                    </a>
                </li>
                <li>
                    <a href="{{ route('rekap_nilai') }}"
                        class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-100 rounded-lg group">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-600" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Rekap Nilai
                    </a>
                </li>
            </ul>
        </div>
        <div class="p-4 border-t border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold text-xs">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'P', 0, 2)) }}</div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-gray-900 truncate">{{ auth()->user()?->name ?? 'Pengguna' }}
                    </div>
                    <div class="text-[10px] text-gray-500 truncate">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-gray-600" title="Keluar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <main class="min-h-screen bg-gray-50 px-4 pb-24 pt-6 sm:ml-64 sm:px-6 sm:pb-12 sm:pt-24">
        <div class="max-w-4xl mx-auto">

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">INVENTORY SOAL •
                        <span class="text-blue-600">TAMBAH MAPEL</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Form Tambah Mata Pelajaran Baru</h1>
                </div>
                <a href="{{ route('inventory') }}"
                    class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 text-xs font-semibold px-3.5 py-2 rounded-lg flex items-center shadow-xs transition">
                    &larr; Kembali
                </a>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl shadow-xs overflow-hidden">

                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                    <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Detail Informasi Mata
                        Pelajaran</span>
                    <span class="text-xs text-blue-600 font-medium">* Wajib diisi</span>
                </div>

                <form action="{{ route('mapel.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6 sm:p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-4">
                            <div>
                                <label for="nama_mapel"
                                    class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-gray-700">Nama
                                    Mata Pelajaran</label>
                                <input type="text" name="nama_mapel" id="nama_mapel"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3"
                                    placeholder="Contoh: Matematika Peminatan" required>
                            </div>

                            <div>
                                <label for="kode_mapel"
                                    class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-gray-700">Kode
                                    Mata Pelajaran</label>
                                <input type="text" name="kode_mapel" id="kode_mapel"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3 uppercase font-mono"
                                    placeholder="Contoh: MTK-P02" required>
                            </div>

                            <div>
                                <label for="fase_class"
                                    class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-gray-700">Fase
                                    / Tingkat Kelas</label>
                                <select id="fase_class" name="fase_class"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3">
                                    <option value="Kelas X (Fase E)">Kelas X (Fase E)</option>
                                    <option value="Kelas XI (Fase F)">Kelas XI (Fase F)</option>
                                    <option value="Kelas XII (Fase F+)" selected>Kelas XII (Fase F+)</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col justify-between">
                            <div>
                                <label
                                    class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-gray-700">Gambar
                                    / Ikon Mata Pelajaran</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                        <div
                                            class="flex flex-col items-center justify-center pt-5 pb-6 px-4 text-center">
                                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 20 16">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.5 5.5 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p id="fileLabelText" class="mb-1 text-xs text-gray-500 font-semibold">
                                                Klik untuk unggah gambar</p>
                                            <p class="text-[10px] text-gray-400">PNG, JPG, atau WEBP (Maks. 10MB)</p>
                                        </div>
                                        <input id="dropzone-file" name="gambar" type="file" class="hidden"
                                            accept="image/*" />
                                    </label>
                                </div>
                                <span id="fileError" class="text-[11px] text-red-500 mt-1 block hidden">Ukuran file
                                    melebihi 10MB! Pilih file yang lebih kecil.</span>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                        <div>
                            <label for="tingkat_kesulitan"
                                class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-gray-700">Tingkat
                                Kesulitan</label>
                            <select name="tingkat_kesulitan" id="tingkat_kesulitan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3">
                                <option value="Mudah">Mudah</option>
                                <option value="Sedang" selected>Sedang</option>
                                <option value="Sulit">Sulit</option>
                            </select>
                        </div>
                        <div>
                            <label for="semester"
                                class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-gray-700">Semester</label>
                            <select name="semester" id="semester"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3">
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="keterangan"
                            class="block mb-1.5 text-xs font-bold uppercase tracking-wider text-gray-700">Deskripsi /
                            Catatan Tambahan</label>
                        <textarea id="keterangan" name="keterangan" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-3"
                            placeholder="Tuliskan deskripsi atau kurikulum acuan mata pelajaran ini..."></textarea>
                    </div>

                    <div class="pt-4 flex items-center justify-end space-x-3 border-t border-gray-200">
                        <a href="{{ route('inventory') }}"
                            class="px-4 py-2.5 text-xs font-semibold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-xs transition flex items-center">
                            Simpan Mata Pelajaran
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-gray-200 bg-white/95 px-3 py-2 shadow-[0_-6px_20px_rgba(15,23,42,0.08)] backdrop-blur sm:hidden">
        <div class="grid grid-cols-3 gap-2 text-[10px] font-semibold">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center gap-1 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-500' }} px-2 py-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12.75L12 4l9 8.75M5 10.5V20h14v-9.5"/></svg>
                Beranda
            </a>
            <a href="{{ route('inventory') }}" class="flex flex-col items-center justify-center gap-1 rounded-xl {{ request()->routeIs('inventory') || request()->routeIs('mapel.show') || request()->routeIs('mapel.create') ? 'bg-blue-50 text-blue-700' : 'text-slate-500' }} px-2 py-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                Inventory
            </a>
            <a href="{{ route('rekap_nilai') }}" class="flex flex-col items-center justify-center gap-1 rounded-xl {{ request()->routeIs('rekap_nilai') ? 'bg-blue-50 text-blue-700' : 'text-slate-500' }} px-2 py-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Rekap
            </a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script>
        // Validasi ukuran file gambar maksimal 10MB di sisi client
        const fileInput = document.getElementById('dropzone-file');
        const fileLabelText = document.getElementById('fileLabelText');
        const fileError = document.getElementById('fileError');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileSizeMB = file.size / (1024 * 1024);
                if (fileSizeMB > 10) {
                    fileError.classList.remove('hidden');
                    fileLabelText.textContent = "File terlalu besar!";
                    fileInput.value = ""; // Reset input
                } else {
                    fileError.classList.add('hidden');
                    fileLabelText.textContent = file.name;
                }
            }
        });
    </script>
</body>

</html>
