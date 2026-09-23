<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $package->nama_package }} - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800">
    <nav class="fixed inset-x-0 top-0 z-50 border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-16 max-w-4xl items-center justify-between px-4">
            <a href="{{ route('student.dashboard') }}" class="text-sm font-semibold text-blue-600">&larr; Pilih package lain</a>
            <div class="flex items-center gap-3">
                <span class="rounded-full bg-blue-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-blue-700" id="exam-timer">{{ (int) ($package->durasi ?? 0) }}:00</span>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="text-xs font-semibold text-slate-500">Keluar</button></form>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-3xl space-y-6 px-4 pb-28 pt-24 md:pb-12">
        <header>
            <p class="text-[10px] font-bold uppercase tracking-widest text-blue-600">{{ $package->mapel->nama_mapel ?? 'Ujian' }}</p>
            <h1 class="mt-1 text-2xl font-black text-slate-900">{{ $package->nama_package }}</h1>
            <p class="mt-1 text-xs text-slate-500">{{ $package->soal->count() }} soal · Selesaikan dalam {{ $package->durasi ?? 0 }} menit.</p>
        </header>

        @if ($examResult)
            <section class="rounded-2xl border border-emerald-200 bg-emerald-50 p-6 shadow-sm">
                <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-600">Ujian selesai</p>
                <h2 class="mt-2 text-2xl font-black text-emerald-900">Skor kamu: {{ $examResult['score'] }}</h2>
                <div class="mt-4 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-xl bg-white p-4 shadow-sm">
                        <p class="text-[10px] uppercase tracking-wider text-slate-500">Jawaban benar</p>
                        <p class="mt-2 text-2xl font-black text-emerald-600">{{ $examResult['correct'] }}</p>
                    </div>
                    <div class="rounded-xl bg-white p-4 shadow-sm">
                        <p class="text-[10px] uppercase tracking-wider text-slate-500">Jawaban salah</p>
                        <p class="mt-2 text-2xl font-black text-rose-600">{{ $examResult['wrong'] }}</p>
                    </div>
                    <div class="rounded-xl bg-white p-4 shadow-sm">
                        <p class="text-[10px] uppercase tracking-wider text-slate-500">Total soal</p>
                        <p class="mt-2 text-2xl font-black text-slate-900">{{ $examResult['total'] }}</p>
                    </div>
                </div>
                <a href="{{ route('student.dashboard') }}" class="mt-5 inline-flex rounded-xl bg-emerald-600 px-4 py-2 text-sm font-bold text-white hover:bg-emerald-700">Kembali ke dashboard</a>
            </section>
        @else
            <form id="student-exam-form" method="POST" action="{{ route('student.exam.submit', $package) }}" class="space-y-4">
                @csrf
                @foreach ($package->soal as $index => $question)
                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-bold text-slate-900"><span class="mr-2 text-blue-600">{{ $index + 1 }}.</span>{{ $question->pertanyaan }}</p>
                        <div class="mt-4 grid gap-2 sm:grid-cols-2">
                            @foreach (['A' => 'pilihan_a', 'B' => 'pilihan_b', 'C' => 'pilihan_c', 'D' => 'pilihan_d', 'E' => 'pilihan_e'] as $letter => $field)
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-3 text-xs hover:border-blue-400 hover:bg-blue-50">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $letter }}" required class="text-blue-600">
                                    <span class="font-bold text-slate-500">{{ $letter }}</span>
                                    <span>{{ $question->{$field} }}</span>
                                </label>
                            @endforeach
                        </div>
                    </article>
                @endforeach
                <button type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white hover:bg-blue-700">Kirim Jawaban</button>
            </form>
        @endif
    </main>

    <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white md:hidden">
        <div class="mx-auto flex max-w-md items-center justify-between px-4 py-2">
            <a href="{{ route('student.dashboard') }}" class="rounded-xl bg-blue-600 px-4 py-2 text-xs font-semibold text-white">Dashboard</a>
            <a href="{{ route('student.leaderboard') }}" class="rounded-xl bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-700">Leaderboard</a>
        </div>
    </nav>

    <script>
        const timerEl = document.getElementById('exam-timer');
        const form = document.getElementById('student-exam-form');
        const durationMinutes = Number('{{ (int) ($package->durasi ?? 0) }}') || 0;

        if (timerEl && form && durationMinutes > 0) {
            const deadline = Date.now() + (durationMinutes * 60 * 1000);

            const updateTimer = () => {
                const remaining = Math.max(deadline - Date.now(), 0);
                const minutes = Math.floor(remaining / 60000);
                const seconds = Math.floor((remaining % 60000) / 1000);

                timerEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                if (remaining <= 0) {
                    timerEl.classList.add('text-red-600');
                    form.requestSubmit();
                }
            };

            updateTimer();
            setInterval(updateTimer, 1000);
        }
    </script>
</body>

</html>
