<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
    <nav class="fixed inset-x-0 top-0 z-50 hidden border-b border-slate-200 bg-white/95 backdrop-blur sm:block">
        <div class="mx-auto flex h-16 max-w-screen-2xl items-center justify-between px-4 sm:px-6">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3"><span
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-sm font-black text-white">B</span><span
                    class="font-bold tracking-tight text-slate-900">Bank Soal</span></a>
            <div class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <p class="text-xs font-bold text-slate-900">{{ auth()->user()?->name ?? 'Pengguna' }}</p>
                    <p class="text-[10px] text-slate-500">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}</p>
                </div><span
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">{{ strtoupper(substr(auth()->user()?->name ?? 'P', 0, 2)) }}</span>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"
                        class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700"
                        title="Keluar"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg></button></form>
            </div>
        </div>
    </nav>
    <aside id="logo-sidebar"
        class="fixed top-16 left-0 z-40 hidden w-64 h-[calc(100vh-4rem)] bg-white border-r border-slate-200 lg:flex lg:flex-col lg:justify-between"
        aria-label="Sidebar">
        <div class="h-full px-4 py-6 overflow-y-auto">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-4 px-3">NAVIGASI UTAMA</div>
            <ul class="space-y-1.5 font-medium text-sm">
                <li><a href="{{ route('dashboard') }}"
                        class="flex items-center px-3 py-2.5 text-blue-700 bg-blue-50 rounded-lg group"><svg
                            class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2-2v-2z" />
                        </svg>Dashboard</a></li>
                <li><a href="{{ route('inventory') }}"
                        class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-100 rounded-lg group"><svg
                            class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>Inventory Soal</a></li>
                <li><a href="{{ route('rekap_nilai') }}"
                        class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-100 rounded-lg group"><svg
                            class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>Rekap Nilai</a></li>
            </ul>
        </div>
        <div class="p-4 border-t border-slate-200 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold text-xs">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'P', 0, 2)) }}</div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-slate-900 truncate">{{ auth()->user()?->name ?? 'Pengguna' }}
                    </div>
                    <div class="text-[10px] text-slate-500 truncate">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"
                    class="text-slate-400 hover:text-slate-600" title="Keluar"><svg class="h-5 w-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg></button></form>
        </div>
    </aside>
    <main class="mx-auto max-w-screen-2xl space-y-6 px-4 pb-24 pt-6 sm:px-6 sm:pt-24 sm:pb-12 lg:ml-64">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-blue-600">Ringkasan pengelolaan</p>
                <h1 class="mt-1 text-2xl font-bold text-slate-900">Dashboard</h1>
                <p class="mt-1 text-sm text-slate-500">Pantau package dan aktivitas bank soal terbaru.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                @if (auth()->user()?->role === 'admin')
                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex w-fit items-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50">+
                        Admin / Guru</a>
                @endif
                <a href="{{ route('mapel.create') }}"
                    class="inline-flex w-fit items-center rounded-xl bg-blue-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-blue-700">
                    + Tambah Mapel</a>
            </div>
        </div>
        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([['Total Soal', $totalSoal, 'Soal tersimpan'], ['Package Aktif', $totalPackages, 'Package tersedia'], ['Mata Pelajaran', $totalMapel, 'Mapel terdaftar'], ['Siswa', $totalSiswa, 'Akun siswa']] as $stat)
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ $stat[0] }}</p>
                    <p class="mt-3 text-3xl font-black text-slate-900">{{ number_format($stat[1]) }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ $stat[2] }}</p>
                </div>
            @endforeach
        </section>
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col justify-between gap-3 border-b border-slate-200 p-5 sm:flex-row sm:items-center">
                <div>
                    <h2 class="font-bold text-slate-900">Package terbaru</h2>
                    <p class="mt-1 text-xs text-slate-500">Package yang terakhir diperbarui atau menerima soal.</p>
                </div><a href="{{ route('inventory') }}"
                    class="text-xs font-semibold text-blue-600 hover:underline">Lihat inventory</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-[10px] uppercase tracking-wider text-slate-400">
                        <tr>
                            <th class="px-5 py-3">Package</th>
                            <th class="px-5 py-3">Mapel</th>
                            <th class="px-5 py-3">Soal</th>
                            <th class="px-5 py-3">Diperbarui</th>
                            <th class="px-5 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($packages as $package)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-4 font-bold text-slate-900">{{ $package->nama_package }}<span
                                        class="mt-1 block text-[10px] font-normal text-slate-400">{{ $package->keterangan_package ?: 'Tanpa keterangan' }}</span>
                                </td>
                                <td class="px-5 py-4 text-slate-600">{{ $package->mapel->nama_mapel ?? '-' }}</td>
                                <td class="px-5 py-4"><span
                                        class="rounded-full bg-blue-50 px-2.5 py-1 font-bold text-blue-700">{{ $package->soal_count }}
                                        soal</span></td>
                                <td class="px-5 py-4 text-slate-500">{{ $package->updated_at?->format('d M Y H:i') }}
                                </td>
                                <td class="px-5 py-4 text-right"><a href="{{ route('package.show', $package) }}"
                                        class="font-semibold text-blue-600 hover:underline">Buka package</a></td>
                        </tr>@empty<tr>
                                <td colspan="5" class="px-5 py-12 text-center text-sm text-slate-500">Belum ada
                                    package soal.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
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
</body>

</html>
