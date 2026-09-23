<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mata Pelajaran & Package Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="fixed inset-x-0 top-0 z-50 hidden border-b border-gray-200 bg-white sm:block">
        <div class="mx-auto flex max-w-screen-2xl flex-wrap items-center justify-between px-4 py-2.5">
            <div class="flex items-center space-x-8">
                <a href="{{ route('inventory') }}" class="flex items-center space-x-2.5">
                    <div class="bg-blue-600 p-1.5 rounded-lg text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                    <span class="self-center text-sm font-bold whitespace-nowrap text-gray-900">Kembali ke
                        Inventory</span>
                </a>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right hidden sm:block">
                    <div class="text-xs font-bold text-gray-900">{{ auth()->user()?->name ?? 'Pengguna' }}</div>
                    <div class="text-[10px] text-gray-500">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}</div>
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
        </div>
    </nav>

    <main class="p-4 pb-24 pt-6 sm:p-8 sm:pt-24 sm:pb-12">
        <div class="max-w-screen-2xl mx-auto space-y-6">

            @if (session('success'))
                <div
                    class="p-4 text-xs text-green-800 rounded-xl bg-green-50 border border-green-200 flex items-center shadow-xs">
                    <svg class="w-4 h-4 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="p-4 text-xs text-red-800 rounded-xl bg-red-50 border border-red-200 flex items-center shadow-xs">
                    <svg class="w-4 h-4 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div
                class="bg-white border border-gray-200 rounded-2xl p-4 sm:p-6 md:p-8 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4 md:gap-6">
                <div
                    class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6 w-full">
                    <div class="w-24 h-24 rounded-xl bg-gray-100 overflow-hidden shrink-0 border border-gray-200">
                        @if ($mapel->gambar)
                            <img src="{{ Storage::url($mapel->gambar) }}" alt="{{ $mapel->nama_mapel }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 text-xs font-medium">No
                                Image</div>
                        @endif
                    </div>
                    <div class="space-y-1.5 w-full">
                        <div class="flex items-center space-x-2">
                            <span
                                class="text-[11px] font-mono font-bold text-blue-600 uppercase tracking-wider bg-blue-50 px-2.5 py-0.5 rounded border border-blue-100">{{ $mapel->kode_mapel }}</span>
                            <span
                                class="bg-gray-100 text-gray-700 text-[11px] font-semibold px-2.5 py-0.5 rounded border border-gray-200">
                                {{ $mapel->fase_class ?? 'Umum' }}
                            </span>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $mapel->nama_mapel }}</h1>
                        <p class="text-xs text-gray-500 max-w-3xl leading-relaxed">
                            {{ $mapel->keterangan ?? 'Tidak ada deskripsi atau catatan tambahan untuk mata pelajaran ini.' }}
                        </p>

                        <div class="flex flex-wrap items-center gap-4 pt-2 text-xs text-gray-600">
                            <div
                                class="flex items-center space-x-1 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200">
                                <span class="text-gray-400">Total Soal Utama:</span>
                                <span class="font-bold text-gray-900">{{ $mapel->inventory->jumlah_soal ?? 0 }}
                                    Butir</span>
                            </div>
                            <div
                                class="flex items-center space-x-1 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200">
                                <span class="text-gray-400">Tingkat / Semester:</span>
                                <span class="font-bold text-gray-900">{{ $mapel->inventory->tingkat_kesulitan ?? '-' }}
                                    ({{ $mapel->inventory->semester ?? '-' }})</span>
                            </div>
                        </div>
                    </div>
                </div>

                <button data-modal-target="addPackageModal" data-modal-toggle="addPackageModal"
                    class="inline-flex items-center justify-center w-full sm:w-auto px-5 py-3 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-xs transition shrink-0 cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Package Soal
                </button>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-6 sm:p-8 shadow-xs space-y-6">
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-gray-100 pb-4">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Daftar Package Soal</h2>
                        <p class="text-xs text-gray-500">Kelompokkan soal berdasarkan ujian, bab, atau jenis penilaian
                            tertentu untuk mata pelajaran ini.</p>
                    </div>
                    <span class="text-xs font-semibold bg-gray-100 text-gray-700 px-3 py-1 rounded-lg w-fit">
                        Total Paket: {{ isset($mapel->packages) ? count($mapel->packages) : 0 }} Paket
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @isset($mapel->packages)
                        @forelse($mapel->packages as $pkg)
                            <div
                                class="border border-gray-200 rounded-xl p-5 hover:border-blue-300 transition bg-white flex flex-col justify-between space-y-4 shadow-2xs">
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider bg-purple-50 text-purple-700 border border-purple-100 px-2.5 py-1 rounded-md">Paket
                                            Ujian</span>
                                        <!-- Menyesuaikan jumlah butir soal berdasarkan relasi soal yang ditambahkan -->
                                        <span
                                            class="text-xs font-semibold text-gray-600 bg-gray-50 px-2 py-0.5 rounded border border-gray-200">{{ method_exists($pkg, 'soal') ? $pkg->soal->count() : $pkg->jumlah_butir ?? 0 }}
                                            Soal</span>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-sm mt-1">{{ $pkg->nama_package }}</h3>
                                    <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                        {{ $pkg->keterangan_package ?? 'Tidak ada keterangan tambahan.' }}</p>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100 text-xs">
                                    <span class="text-gray-400 text-[11px]">Dibuat:
                                        {{ $pkg->created_at ? $pkg->created_at->format('d M Y') : '-' }}</span>
                                    <a href="{{ route('package.show', $pkg->id) }}"
                                        class="text-blue-600 font-semibold hover:underline inline-flex items-center">
                                        Kelola Soal
                                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <!-- State kosong tetap sama -->
                        @endforelse
                    @endisset
                </div>
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

    <div id="addPackageModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900/50 backdrop-blur-xs">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base font-bold text-gray-900">Tambah Package Soal Baru</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-xs w-8 h-8 ms-auto inline-flex justify-center items-center transition"
                        data-modal-hide="addPackageModal">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('package.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">

                    <div>
                        <label class="block mb-1.5 text-xs font-bold uppercase text-gray-700 tracking-wider">Nama
                            Package / Judul Ujian</label>
                        <input type="text" name="nama_package"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-xl block w-full p-3 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: Paket A - Ulangan Harian Bab 1" required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="rounded-xl border border-blue-100 bg-blue-50/60 p-3 sm:p-4">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-blue-700">Jumlah soal</p>
                            <p class="mt-2 text-xs text-gray-600 leading-relaxed">Jumlah butir soal akan mengikuti data soal yang ditambahkan di package ini.</p>
                        </div>
                        <div>
                            <label class="block mb-1.5 text-xs font-bold uppercase text-gray-700 tracking-wider">Durasi
                                (Menit)</label>
                            <input type="number" name="durasi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-xl block w-full p-3 focus:ring-blue-500 focus:border-blue-500"
                                value="60" min="5">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-bold uppercase text-gray-700 tracking-wider">Keterangan
                            / Petunjuk Pengerjaan</label>
                        <textarea name="keterangan_package" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-xl block w-full p-3 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Catatan atau instruksi untuk paket soal ini..."></textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                        <button data-modal-hide="addPackageModal" type="button"
                            class="px-5 py-2.5 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition">Batal</button>
                        <button type="submit"
                            class="px-5 py-2.5 text-xs font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-xs transition">Simpan
                            Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>
