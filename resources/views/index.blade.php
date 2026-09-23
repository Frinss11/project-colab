<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index File Blade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-800">
    <main class="mx-auto max-w-5xl px-4 py-10">
        <div class="mb-8 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-blue-600">Daftar File</p>
            <h1 class="mt-3 text-3xl font-black text-slate-900">Index Semua File Blade</h1>
            <p class="mt-2 text-sm text-slate-500">Semua file view yang ada di folder resources/views</p>
        </div>

        <div class="space-y-3">
            @forelse ($views as $view)
                <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">File</p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">{{ str_replace('.blade.php', '', $view) }}</p>
                    <p class="mt-2 break-all text-xs text-slate-500">{{ $view }}</p>
                </div>
            @empty
                <div class="rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center text-sm text-slate-500">
                    Tidak ada file Blade yang ditemukan.
                </div>
            @endforelse
        </div>
    </main>
</body>

</html>
