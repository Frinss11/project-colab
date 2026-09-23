<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">
    <nav class="fixed inset-x-0 top-0 z-50 hidden border-b border-slate-200 bg-white/95 backdrop-blur sm:block">
        <div class="mx-auto flex h-16 max-w-screen-2xl items-center justify-between px-4 sm:px-6"><a
                href="{{ route('dashboard') }}" class="flex items-center gap-3"><span
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-sm font-black text-white">B</span><span
                    class="font-bold tracking-tight text-slate-900">Bank Soal</span></a>
            <div class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <p class="text-xs font-bold text-slate-900">{{ auth()->user()?->name ?? 'Pengguna' }}</p>
                    <p class="text-[10px] text-slate-500">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}</p>
                </div><span
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">{{ strtoupper(substr(auth()->user()?->name ?? 'P', 0, 2)) }}</span>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"
                        class="rounded-lg p-2 text-slate-400 hover:bg-slate-100" title="Keluar"><svg class="h-5 w-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg></button></form>
            </div>
        </div>
    </nav>
    <aside
        class="fixed left-0 top-16 z-40 hidden h-[calc(100vh-4rem)] w-64 border-r border-slate-200 bg-white lg:flex lg:flex-col lg:justify-between">
        <div class="h-full px-4 py-6">
            <div class="mb-4 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400">NAVIGASI UTAMA</div>
            <ul class="space-y-1.5 text-sm font-medium">
                <li><a href="{{ route('dashboard') }}"
                        class="flex items-center rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100"><svg
                            class="mr-3 h-5 w-5 text-slate-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2-2v-2z" />
                        </svg>Dashboard</a></li>
                <li><a href="{{ route('inventory') }}"
                        class="flex items-center rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-100"><svg
                            class="mr-3 h-5 w-5 text-slate-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>Inventory Soal</a></li>
                <li><a href="{{ route('rekap_nilai') }}"
                        class="flex items-center rounded-lg bg-blue-50 px-3 py-2.5 text-blue-700"><svg
                            class="mr-3 h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>Rekap Nilai</a></li>
            </ul>
        </div>
        <div class="flex items-center justify-between border-t border-slate-200 p-4">
            <div class="flex items-center gap-3"><span
                    class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-xs font-semibold text-blue-700">{{ strtoupper(substr(auth()->user()?->name ?? 'P', 0, 2)) }}</span>
                <div>
                    <div class="max-w-32 truncate text-xs font-bold text-slate-900">
                        {{ auth()->user()?->name ?? 'Pengguna' }}</div>
                    <div class="text-[10px] text-slate-500">{{ ucfirst(auth()->user()?->role ?? 'Pengguna') }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="text-slate-400"
                    title="Keluar"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg></button></form>
        </div>
    </aside>
    <main class="mx-auto max-w-screen-2xl space-y-6 px-4 pb-24 pt-6 sm:px-6 sm:pb-12 sm:pt-24 lg:ml-64">
        <header>
            <p class="text-[11px] font-bold uppercase tracking-widest text-blue-600">Penilaian siswa</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Rekap Nilai per Package</h1>
            <p class="mt-1 text-sm text-slate-500">Klik package untuk melihat seluruh siswa yang sudah mengerjakan.</p>
        </header>
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs text-emerald-800">
                {{ session('success') }}</div>
        @endif
        <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 p-5">
                <h2 class="font-bold text-slate-900">Package terbaru</h2>
                <p class="mt-1 text-xs text-slate-500">Daftar package yang tersedia untuk direkap.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-[10px] uppercase tracking-wider text-slate-400">
                        <tr>
                            <th class="px-5 py-3">Package</th>
                            <th class="px-5 py-3">Mapel</th>
                            <th class="px-5 py-3">Soal</th>
                            <th class="px-5 py-3">Siswa</th>
                            <th class="px-5 py-3">Rata-rata</th>
                            <th class="px-5 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($packages as $package)
                            <tr class="cursor-pointer hover:bg-blue-50"
                                onclick="document.getElementById('package-{{ $package->id }}').scrollIntoView({behavior:'smooth'})">
                                <td class="px-5 py-4 font-bold text-slate-900">{{ $package->nama_package }}</td>
                                <td class="px-5 py-4 text-slate-600">{{ $package->mapel->nama_mapel ?? '-' }}</td>
                                <td class="px-5 py-4"><span
                                        class="rounded-full bg-blue-50 px-2.5 py-1 font-bold text-blue-700">{{ $package->soal_count }}</span>
                                </td>
                                <td class="px-5 py-4 text-slate-600">{{ $package->nilai->count() }}</td>
                                <td class="px-5 py-4 font-bold text-slate-900">
                                    {{ $package->nilai->count() ? round($package->nilai->avg('nilai'), 1) : '-' }}</td>
                                <td class="px-5 py-4 text-right"><a href="#package-{{ $package->id }}"
                                        class="font-semibold text-blue-600">Buka rekap</a></td>
                        </tr>@empty<tr>
                                <td colspan="6" class="px-5 py-12 text-center text-slate-500">Belum ada package
                                    untuk direkap.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        @foreach ($packages as $package)
            <section id="package-{{ $package->id }}"
                class="scroll-mt-24 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                <div
                    class="flex flex-col justify-between gap-3 border-b border-slate-200 p-5 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="font-bold text-slate-900">{{ $package->nama_package }}</h2>
                        <p class="mt-1 text-xs text-slate-500">{{ $package->mapel->nama_mapel ?? '-' }} ·
                            {{ $package->nilai->count() }} siswa mengerjakan</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2"><span
                            class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">Rata-rata
                            {{ $package->nilai->count() ? round($package->nilai->avg('nilai'), 1) : '-' }}</span><a
                            href="{{ route('rekap_nilai.excel', $package) }}"
                            class="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-[11px] font-semibold text-emerald-700">Excel</a><a
                            href="{{ route('rekap_nilai.word', $package) }}"
                            class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-[11px] font-semibold text-blue-700">Word</a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-[10px] uppercase tracking-wider text-slate-400">
                            <tr>
                                <th class="px-5 py-3">Siswa</th>
                                <th class="px-5 py-3">Nilai</th>
                                <th class="px-5 py-3">Keterangan</th>
                                <th class="px-5 py-3">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($package->nilai as $result)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-4 font-semibold text-slate-900">
                                        {{ $result->user->name ?? 'Siswa #' . $result->users_id }}<span
                                            class="block text-[10px] font-normal text-slate-400">{{ $result->user->email ?? '-' }}</span>
                                    </td>
                                    <td class="px-5 py-4"><span
                                            class="text-base font-black {{ $result->nilai >= 75 ? 'text-emerald-600' : 'text-red-600' }}">{{ $result->nilai }}</span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        {{ $result->keterangan ?: ($result->nilai >= 75 ? 'Lulus' : 'Remedial') }}</td>
                                    <td class="px-5 py-4 text-slate-500">
                                        {{ $result->created_at?->format('d M Y H:i') }}</td>
                            </tr>@empty<tr>
                                    <td colspan="4" class="px-5 py-10 text-center text-slate-500">Belum ada siswa
                                        yang mengerjakan package ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        @endforeach
        @if ($legacyResults->isNotEmpty())
            <section class="rounded-xl border border-amber-200 bg-amber-50 p-5">
                <h2 class="font-bold text-amber-900">Nilai lama tanpa package</h2>
                <p class="mt-1 text-xs text-amber-800">{{ $legacyResults->count() }} data belum terhubung ke package.
                </p>
            </section>
        @endif
    </main>
</body>

</html>
