<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin atau Guru - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    <nav class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-16 max-w-4xl items-center justify-between px-4">
            <a href="{{ route('dashboard') }}" class="font-bold text-slate-900">Bank Soal</a>
            <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-blue-600">Kembali ke dashboard</a>
        </div>
    </nav>
    <main class="mx-auto max-w-xl px-4 py-10">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-[10px] font-bold uppercase tracking-widest text-blue-600">Khusus administrator</p>
            <h1 class="mt-2 text-2xl font-black text-slate-900">Tambah Admin atau Guru</h1>
            <p class="mt-2 text-xs text-slate-500">Register publik hanya membuat akun siswa.</p>

            @if ($errors->any())
                <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-3 text-xs text-red-700">
                    <ul class="list-disc space-y-1 pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.store') }}" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="name" class="mb-1 block text-xs font-semibold text-slate-700">Nama lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm">
                </div>
                <div>
                    <label for="email" class="mb-1 block text-xs font-semibold text-slate-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm">
                </div>
                <div>
                    <label for="role" class="mb-1 block text-xs font-semibold text-slate-700">Role</label>
                    <select id="role" name="role" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm">
                        <option value="guru" @selected(old('role') === 'guru')>Guru</option>
                        <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                    </select>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div><label for="password" class="mb-1 block text-xs font-semibold text-slate-700">Password</label><input id="password" type="password" name="password" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm"></div>
                    <div><label for="password_confirmation" class="mb-1 block text-xs font-semibold text-slate-700">Konfirmasi password</label><input id="password_confirmation" type="password" name="password_confirmation" required class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm"></div>
                </div>
                <button type="submit" class="w-full rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white hover:bg-blue-700">Buat akun</button>
            </form>
        </div>
    </main>
</body>
</html>
