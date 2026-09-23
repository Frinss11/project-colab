<x-guest-layout>

    <!-- Session Status -->
    <div class="bg-sky-100 flex justify-center items-center h-screen">
        <!-- Left: Image & Text Overlay -->
        <div class="w-1/2 h-screen hidden lg:block relative">
            <!-- Ganti URL gambar dengan tema edukasi/ujian/belajar -->
            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1000&auto=format&fit=crop"
                alt="Ilustrasi Bank Soal & Ujian" class="object-cover w-full h-full">

            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-black/60"></div>

            <div class="absolute inset-0 flex flex-col justify-between p-12 text-white">
                <div>
                    <span class="text-sky-400 font-extrabold tracking-wider text-xl uppercase">BANK SOAL DIGITAL</span>
                </div>

                <div>
                    <h2 class="text-4xl font-extrabold mb-3 leading-tight">KELOLA & BUAT SOAL LEBIH MUDAH!</h2>
                    <p class="text-gray-100 text-lg max-w-lg">Platform pembuatan paket ujian, bank soal interaktif, dan
                        evaluasi pembelajaran terbaik untuk guru dan siswa.</p>
                </div>
            </div>
        </div>

        <!-- Right: Login Form -->
        <div class="lg:p-24 md:p-52 sm:p-20 p-8 w-full lg:w-1/2 flex flex-col justify-center">
            <h1 class="text-2xl font-semibold mb-4 text-gray-800">Login</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="mb-4">
                    <label for="email" class="block text-gray-600 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 bg-white">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-800 mb-1">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 bg-white">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md py-2 px-4 w-full transition duration-200">Login</button>
            </form>

            <div class="flex items-center my-4">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="mx-3 text-gray-400 text-xs">Atau masuk dengan</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <div class="flex justify-center mb-4">
                <a href="{{ route('google.redirect') }}"
                    class="flex items-center justify-center w-12 h-12 bg-white border border-gray-300 rounded-full shadow-sm hover:bg-gray-50 transition duration-200"
                    title="Login dengan Google">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z" />
                        <path fill="#34A853"
                            d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.11-6.72-4.96H1.14v3.15C3.15 21.35 7.23 24 12 24z" />
                        <path fill="#FBBC05"
                            d="M5.28 14.24c-.25-.72-.38-1.49-.38-2.24s.13-1.52.38-2.24V6.6H1.14C.41 8.08 0 9.75 0 12s.41 3.92 1.14 5.4l4.14-3.16z" />
                        <path fill="#EA4335"
                            d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.23 0 3.15 2.65 1.14 6.6l4.14 3.15c.95-2.85 3.6-4.96 6.72-4.96z" />
                    </svg>
                </a>
            </div>

            <div class="mt-2 text-center text-sm text-gray-600">
                Belum Punya Akun? <a href="{{ route('register') }}"
                    class="text-green-500 font-medium hover:underline">Daftar</a>
            </div>
        </div>
    </div>
</x-guest-layout>
