<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Bank Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-sky-50 text-slate-800">
    <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-sky-100 via-white to-blue-100 p-4">
        <div class="grid w-full max-w-6xl overflow-hidden rounded-[28px] border border-sky-200 bg-white shadow-[0_20px_60px_rgba(14,116,144,0.12)] lg:grid-cols-2">
            <div class="relative hidden min-h-[560px] lg:block">
                <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1200&auto=format&fit=crop"
                    alt="Bank Soal Illustration"
                    class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-900/65 via-sky-900/30 to-slate-900/75"></div>

                <div class="absolute inset-0 flex flex-col justify-between p-10 text-white">
                    <div>
                        <span class="text-xs font-black uppercase tracking-[0.35em] text-sky-300">Bank Soal Digital</span>
                    </div>

                    <div>
                        <p class="mb-3 text-sm font-semibold uppercase tracking-[0.28em] text-sky-200">Keamanan akun</p>
                        <h1 class="max-w-md text-4xl font-black leading-tight">Buat password baru agar tetap aman.</h1>
                        <p class="mt-4 max-w-md text-base text-slate-200">
                            Atur ulang kata sandi Anda untuk melanjutkan proses belajar dan ujian dengan aman.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center p-6 sm:p-10 lg:p-12">
                <div class="w-full max-w-md">
                    <div class="mb-8 text-center lg:text-left">
                        <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-600 text-2xl font-black text-white shadow-lg shadow-sky-200">
                            B
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-sky-600">Reset Password</p>
                        <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-900">Atur ulang kata sandi</h2>
                    </div>

                    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100" placeholder="nama@email.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password Baru</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100" placeholder="Masukkan password baru">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-100" placeholder="Ulangi password baru">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl bg-gradient-to-r from-sky-600 to-blue-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-sky-200 transition hover:from-sky-700 hover:to-blue-700">
                            Reset Password
                        </button>
                    </form>

                    <div class="mt-6 text-center text-sm text-slate-600">
                        Sudah ingat password?
                        <a href="{{ route('login') }}" class="font-semibold text-sky-600 hover:text-sky-700 hover:underline">Kembali ke login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

