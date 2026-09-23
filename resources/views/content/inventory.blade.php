<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Soal & Katalog Mata Pelajaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
    <!-- Navbar -->
    <nav class="fixed inset-x-0 top-0 z-50 hidden border-b border-slate-200 bg-white/95 backdrop-blur sm:block">
        <div class="mx-auto flex h-16 max-w-screen-2xl items-center justify-between px-4 sm:px-6">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <span
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-sm font-black text-white">B</span>
                <span class="font-bold tracking-tight text-slate-900">Bank Soal</span>
            </a>
            <div class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <p class="text-xs font-bold text-slate-900">{{ auth()->user()?->name ?? 'Pengguna' }}</p>
                    <p class="text-[10px] text-slate-500">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}</p>
                </div>
                <span
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'P', 0, 2)) }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700"
                        title="Keluar">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="logo-sidebar"
        class="fixed top-16 left-0 z-40 hidden w-64 h-[calc(100vh-4rem)] bg-white border-r border-slate-200 lg:flex lg:flex-col lg:justify-between"
        aria-label="Sidebar">
        <div class="h-full px-4 py-6 overflow-y-auto">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-4 px-3">NAVIGASI UTAMA</div>
            <ul class="space-y-1.5 font-medium text-sm">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-100 rounded-lg group">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('inventory') }}"
                        class="flex items-center px-3 py-2.5 text-blue-700 bg-blue-50 rounded-lg group">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>Inventory Soal
                    </a>
                </li>
                <li>
                    <a href="{{ route('rekap_nilai') }}"
                        class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-100 rounded-lg group">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>Rekap Nilai
                    </a>
                </li>
            </ul>
        </div>
        <div class="p-4 border-t border-slate-200 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold text-xs">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'P', 0, 2)) }}
                </div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-slate-900 truncate">{{ auth()->user()?->name ?? 'Pengguna' }}
                    </div>
                    <div class="text-[10px] text-slate-500 truncate">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-slate-600" title="Keluar">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="min-h-screen bg-slate-50 px-4 pb-24 pt-6 sm:ml-64 sm:px-6 sm:pb-12 sm:pt-24">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Header Title & Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">ADMIN PORTAL • <span
                            class="text-blue-600">INVENTORY SOAL</span></div>
                    <h1 class="text-2xl font-bold text-slate-900">Bank Soal & Katalog Mata Pelajaran</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola bank soal kurikulum berdasarkan mata pelajaran dan
                        butir soal dalam format kartu interaktif.</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('mapel.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl flex items-center shadow-xs transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Mapel Baru
                    </a>
                </div>
            </div>

            <!-- Search Bar Section -->
            <div
                class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs flex flex-col md:flex-row items-center justify-between gap-3">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input id="inventorySearch" type="text"
                        placeholder="Cari berdasarkan nama mata pelajaran, kode mapel, atau keterangan..."
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-9 pr-4 py-2.5">
                </div>
            </div>

            <!-- Subject Pills Bar -->
            <div id="subjectFilters"
                class="flex items-center space-x-2 overflow-x-auto pb-2 scrollbar-none text-xs font-semibold">
                <button type="button" data-subject=""
                    class="subject-filter bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm whitespace-nowrap transition">Semua
                    (<span id="totalCount">{{ $mapel->count() }}</span>)</button>
                @foreach ($mapel as $subject)
                    <button type="button" data-subject="{{ strtolower($subject->nama_mapel) }}"
                        class="subject-filter bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 px-4 py-2 rounded-lg whitespace-nowrap transition">{{ $subject->nama_mapel }}</button>
                @endforeach
            </div>

            <!-- Cards Grid -->
            <div id="cardsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($mapel as $item)
                    <div data-inventory-card
                        data-search="{{ strtolower($item->nama_mapel . ' ' . $item->kode_mapel . ' ' . ($item->keterangan ?? '')) }}"
                        data-subject="{{ strtolower($item->nama_mapel) }}"
                        class="bg-white border border-slate-200 rounded-xl shadow-xs overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                        <div>
                            <div class="h-40 w-full bg-slate-100 relative overflow-hidden">
                                @if ($item->gambar)
                                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_mapel }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="flex items-center justify-center h-full text-slate-400 text-xs font-medium bg-slate-50">
                                        Tidak ada gambar
                                    </div>
                                @endif
                                <!-- Badge Fase/Kelas -->
                                <span
                                    class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-xs">
                                    {{ $item->fase_class ?? 'Umum' }}
                                </span>
                            </div>

                            <div class="p-5 space-y-3">
                                <div>
                                    <span
                                        class="text-[11px] font-mono font-semibold text-blue-600 uppercase tracking-wider">{{ $item->kode_mapel }}</span>
                                    <h3 class="text-base font-bold text-slate-900 mt-0.5">{{ $item->nama_mapel }}</h3>
                                </div>

                                <p class="text-xs text-slate-500 line-clamp-2">
                                    {{ $item->keterangan ?? 'Belum ada deskripsi atau catatan tambahan untuk mata pelajaran ini.' }}
                                </p>

                                <!-- Informasi Card: Jumlah Package, Fase, dan Tingkat Kesulitan -->
                                <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100 text-xs">
                                    <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                        <span class="block text-slate-400 text-[10px] uppercase font-semibold">Jumlah
                                            Package</span>
                                        <span class="font-bold text-slate-800 text-sm">
                                            {{ isset($item->packages) ? count($item->packages) : 0 }} Paket
                                        </span>
                                    </div>
                                    <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                        <span class="block text-slate-400 text-[10px] uppercase font-semibold">Fase &
                                            Kesulitan</span>
                                        <span class="font-semibold text-slate-800 block truncate">
                                            {{ $item->fase_class ?? '-' }}
                                        </span>
                                        <span class="text-[11px] text-slate-500">
                                            {{ $item->inventory?->tingkat_kesulitan ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="px-5 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-400 text-[11px]">Dibuat:
                                {{ $item->created_at->format('d M Y') }}</span>
                            <a href="{{ route('mapel.show', $item->id) }}"
                                class="px-3 py-1.5 text-blue-600 hover:bg-blue-50 font-semibold rounded-lg transition">Detail</a>
                        </div>
                    </div>
                @empty
                    <div id="emptyState"
                        class="col-span-full py-12 text-center bg-white border border-slate-200 rounded-xl">
                        <p class="text-sm font-semibold text-slate-600">Belum ada data mata pelajaran.</p>
                    </div>
                @endforelse
            </div>

            <!-- Empty Search Result Indicator (Hidden by default) -->
            <div id="noResultState" class="hidden py-12 text-center bg-white border border-slate-200 rounded-xl">
                <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <p class="text-sm font-semibold text-slate-600">Pencarian tidak ditemukan</p>
                <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci atau nama mata pelajaran yang lain.</p>
            </div>

        </div>
    </main>

    <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white/95 px-3 py-2 shadow-[0_-6px_20px_rgba(15,23,42,0.08)] backdrop-blur sm:hidden">
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

    <!-- Script Search & Filter -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script>
        const searchInput = document.getElementById('inventorySearch');
        const cards = [...document.querySelectorAll('[data-inventory-card]')];
        const noResultState = document.getElementById('noResultState');
        let activeSubject = '';

        function filterCards() {
            const term = (searchInput.value || '').toLowerCase().trim();
            let visibleCount = 0;

            cards.forEach((card) => {
                const textSearch = card.dataset.search || '';
                const cardSubject = card.dataset.subject || '';

                const matchesSearch = textSearch.includes(term);
                const matchesSubject = !activeSubject || cardSubject === activeSubject;

                if (matchesSearch && matchesSubject) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            if (visibleCount === 0 && cards.length > 0) {
                noResultState.classList.remove('hidden');
            } else {
                noResultState.classList.add('hidden');
            }
        }

        searchInput.addEventListener('input', filterCards);

        document.querySelectorAll('.subject-filter').forEach((button) => {
            button.addEventListener('click', () => {
                activeSubject = button.dataset.subject;

                document.querySelectorAll('.subject-filter').forEach((item) => {
                    item.className =
                        'subject-filter bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 px-4 py-2 rounded-lg whitespace-nowrap transition';
                });
                button.className =
                    'subject-filter bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm whitespace-nowrap transition';

                filterCards();
            });
        });
    </script>
</body>

</html>
