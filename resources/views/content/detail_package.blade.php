<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $package->nama_package }} - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">
    <nav class="bg-white fixed w-full z-50 top-0 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('mapel.show', $package->mapel_id) }}" class="text-sm font-semibold text-blue-600 hover:underline">
                &larr; Kembali ke {{ $package->mapel->nama_mapel ?? 'Mata Pelajaran' }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-semibold text-gray-500 hover:text-gray-900">Keluar</button>
            </form>
        </div>
    </nav>

    <main class="pt-24 pb-12 px-3 sm:px-4 max-w-6xl mx-auto space-y-6">
        @if (session('success'))
            <div class="p-4 text-xs text-green-800 rounded-xl bg-green-50 border border-green-200">{{ session('success') }}</div>
        @endif

        <header class="bg-white border border-gray-200 rounded-2xl p-4 sm:p-6 flex flex-col gap-4 sm:flex-row sm:items-center justify-between">
            <div class="min-w-0">
                <p class="text-[11px] uppercase tracking-wider font-bold text-blue-600">Package Soal</p>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mt-1 break-words">{{ $package->nama_package }}</h1>
                <p class="text-xs text-gray-500 mt-2 leading-relaxed">{{ $package->keterangan_package ?? 'Tidak ada keterangan tambahan.' }}</p>
                <p class="text-xs text-gray-500 mt-2">{{ $package->soal->count() }} soal tersimpan</p>
            </div>
            <a href="{{ route('tambah_soal', ['package_id' => $package->id]) }}"
                class="inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl w-full sm:w-auto">
                + Tambah Soal ke Package
            </a>
        </header>

        <section class="space-y-4">
            @forelse ($package->soal as $index => $soal)
                <article class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                        <h2 class="text-sm font-bold text-gray-900 leading-relaxed">{{ $index + 1 }}. {{ $soal->pertanyaan }}</h2>
                        <span class="shrink-0 w-fit text-[10px] font-bold text-blue-700 bg-blue-50 px-2 py-1 rounded">Jawaban {{ $soal->jawaban }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-4 text-xs text-gray-600">
                        <div class="bg-gray-50 rounded-lg p-2 break-words"><strong>A.</strong> {{ $soal->pilihan_a }}</div>
                        <div class="bg-gray-50 rounded-lg p-2 break-words"><strong>B.</strong> {{ $soal->pilihan_b }}</div>
                        <div class="bg-gray-50 rounded-lg p-2 break-words"><strong>C.</strong> {{ $soal->pilihan_c }}</div>
                        <div class="bg-gray-50 rounded-lg p-2 break-words"><strong>D.</strong> {{ $soal->pilihan_d }}</div>
                        <div class="bg-gray-50 rounded-lg p-2 break-words sm:col-span-2"><strong>E.</strong> {{ $soal->pilihan_e }}</div>
                    </div>
                </article>
            @empty
                <div class="bg-white border border-dashed border-gray-300 rounded-xl p-12 text-center">
                    <p class="text-sm font-semibold text-gray-600">Belum ada soal di package ini.</p>
                    <p class="text-xs text-gray-400 mt-1">Gunakan tombol tambah soal untuk mengisi package.</p>
                </div>
            @endforelse
        </section>
    </main>
</body>

</html>
