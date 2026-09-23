<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800">
    <nav class="fixed inset-x-0 top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4"><a
                href="{{ route('student.dashboard') }}" class="flex items-center gap-3"><span
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 font-black text-white">B</span><span
                    class="font-bold text-slate-900">Bank Soal</span></a>
            <div class="flex items-center gap-2"><a href="{{ route('student.dashboard') }}"
                    class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100">Dashboard</a><a
                    href="{{ route('student.leaderboard') }}"
                    class="rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700">Leaderboard</a>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" title="Keluar"
                        class="rounded-lg p-2 text-slate-400 hover:bg-slate-100"><svg class="h-5 w-5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg></button></form>
            </div>
        </div>
    </nav>
    <main class="mx-auto max-w-6xl space-y-6 px-4 pb-12 pt-24">
        <header>
            <p class="text-[11px] font-bold uppercase tracking-widest text-blue-600">Performa belajar</p>
            <h1 class="mt-1 text-3xl font-black text-slate-900">Leaderboard keseluruhan</h1>
            <p class="mt-2 text-sm text-slate-500">Peringkat berdasarkan rata-rata nilai dari seluruh package yang sudah
                dikerjakan.</p>
        </header>
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs text-emerald-800">
                {{ session('success') }}</div>
        @endif
        <div class="grid gap-6 lg:grid-cols-3">
            <section class="rounded-2xl border border-blue-200 bg-blue-700 p-6 text-white shadow-sm lg:col-span-1">
                <p class="text-xs text-blue-200">Peringkat kamu</p>
                <p class="mt-2 text-5xl font-black">{{ $myRank ? '#' . $myRank : '-' }}</p>
                <p class="mt-5 text-sm font-bold">{{ auth()->user()->name }}</p>
                <p class="mt-1 text-xs text-blue-200">{{ $myResults->count() }} package dikerjakan · Rata-rata
                    {{ $myResults->count() ? round($myResults->avg('nilai'), 1) : '-' }}</p>
            </section>
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">
                <div class="border-b border-slate-200 p-5">
                    <h2 class="font-bold text-slate-900">Peringkat siswa</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-[10px] uppercase tracking-wider text-slate-400">
                            <tr>
                                <th class="px-5 py-3">#</th>
                                <th class="px-5 py-3">Siswa</th>
                                <th class="px-5 py-3">Package</th>
                                <th class="px-5 py-3">Rata-rata</th>
                                <th class="px-5 py-3">Terbaik</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($ranking as $index => $row)
                                <tr class="{{ $row->user?->id === auth()->id() ? 'bg-blue-50' : '' }}">
                                    <td class="px-5 py-4 font-black text-blue-600">{{ $index + 1 }}</td>
                                    <td class="px-5 py-4 font-bold text-slate-900">{{ $row->user->name ?? 'Siswa' }}
                                    </td>
                                    <td class="px-5 py-4 text-slate-500">{{ $row->total }}</td>
                                    <td class="px-5 py-4 text-base font-black text-slate-900">{{ $row->average }}</td>
                                    <td class="px-5 py-4 font-semibold text-emerald-600">{{ $row->best }}</td>
                            </tr>@empty<tr>
                                    <td colspan="5" class="px-5 py-12 text-center text-slate-500">Belum ada hasil
                                        ujian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
