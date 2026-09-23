<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
    <nav class="fixed inset-x-0 top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 font-black text-white">B</span>
                <span class="font-bold text-slate-900">Bank Soal</span>
            </a>
            <div class="hidden items-center gap-2 md:flex">
                <a href="{{ route('student.dashboard') }}" class="rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700">Dashboard</a>
                <a href="{{ route('student.leaderboard') }}" class="rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100">Leaderboard</a>
                <span class="ml-2 text-right">
                    <b class="block text-xs text-slate-900">{{ auth()->user()->name }}</b>
                    <small class="text-[10px] text-slate-500">Siswa</small>
                </span>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" title="Keluar" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg></button></form>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-6xl space-y-8 px-4 pb-28 pt-24 md:pb-12">
        <header>
            <p class="text-[11px] font-bold uppercase tracking-widest text-blue-600">Ruang belajar</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Mau belajar apa hari ini?</h1>
            <p class="mt-2 text-sm text-slate-500">Pilih mata pelajaran, lalu mulai package soal yang tersedia.</p>
        </header>

        <section class="grid gap-5 md:grid-cols-2">
            @forelse ($mapels as $mapel)
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 p-5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-blue-600">{{ $mapel->kode_mapel }}</p>
                        <h2 class="mt-1 text-lg font-bold text-slate-900">{{ $mapel->nama_mapel }}</h2>
                        <p class="mt-1 text-xs text-slate-500">{{ $mapel->keterangan ?: 'Pilih package untuk mulai mengerjakan.' }}</p>
                    </div>
                    <div class="space-y-2 p-4">
                        @forelse ($mapel->packages as $package)
                            @if ($package->soal_count)
                                <a href="{{ route('student.exam', $package) }}" data-start-exam class="flex items-center justify-between rounded-xl border border-slate-200 p-4 transition hover:border-blue-400 hover:bg-blue-50/40">
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900">{{ $package->nama_package }}</h3>
                                        <p class="mt-1 text-[11px] text-slate-500">{{ $package->soal_count }} soal · {{ $package->durasi ?? '-' }} menit</p>
                                    </div>
                                    <span class="text-xs font-bold text-blue-600">Mulai →</span>
                                </a>
                            @else
                                <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 p-4 opacity-60">
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900">{{ $package->nama_package }}</h3>
                                        <p class="mt-1 text-[11px] text-slate-500">Belum ada soal · {{ $package->durasi ?? '-' }} menit</p>
                                    </div>
                                    <span class="text-xs font-bold text-slate-400">Belum siap</span>
                                </div>
                            @endif
                        @empty
                            <p class="rounded-xl bg-slate-50 p-4 text-xs text-slate-500">Belum ada package untuk mata pelajaran ini.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center text-sm text-slate-500 md:col-span-2">
                    Belum ada mata pelajaran yang tersedia.
                </div>
            @endforelse
        </section>
    </main>

    <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white md:hidden">
        <div class="mx-auto grid max-w-md grid-cols-2 gap-2 px-4 py-2">
            <a href="{{ route('student.dashboard') }}" class="rounded-xl bg-blue-600 px-3 py-2 text-center text-xs font-semibold text-white">Dashboard</a>
            <a href="{{ route('student.leaderboard') }}" class="rounded-xl bg-slate-100 px-3 py-2 text-center text-xs font-semibold text-slate-700">Leaderboard</a>
        </div>
    </nav>

    <script>
        document.querySelectorAll('[data-start-exam]').forEach((link) => {
            link.addEventListener('click', function (event) {
                const confirmed = window.confirm('Apakah kamu yakin ingin memulai paket soal ini?');
                if (!confirmed) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>
