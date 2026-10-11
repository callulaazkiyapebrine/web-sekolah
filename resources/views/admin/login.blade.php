<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SDN PASIRSALAM</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col justify-between">

    <!-- NAVBAR ATAS -->
    <header class="w-full pt-6 px-4">
        <div class="max-w-5xl mx-auto bg-white/80 backdrop-blur-md shadow-sm rounded-2xl px-6 py-3 flex items-center justify-between border border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-[#0284c7] text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">
                    SD
                </div>
                <span class="font-bold text-slate-700 text-sm tracking-wide">SDN PASIRSALAM</span>
            </div>
            <nav class="flex items-center gap-6 text-xs font-semibold text-slate-600">
                <a href="{{ url('/') }}" class="hover:text-[#0284c7] transition-colors">Beranda Utama</a>
            </nav>
        </div>
    </header>

    <!-- FORM LOGIN CENTERED -->
    <main class="flex-1 flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-slate-100 my-auto">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-slate-800">Selamat Datang</h3>
                <p class="text-xs text-slate-400 mt-1">Masukkan email dan password untuk masuk ke Panel Admin</p>
            </div>

            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="mb-4 p-3 text-xs text-rose-600 bg-rose-50 border border-rose-100 rounded-xl">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 text-xs text-rose-600 bg-rose-50 border border-rose-100 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.proses') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-600 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 text-xs text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0284c7] focus:outline-none transition-all placeholder:text-slate-300"
                        placeholder="admin@sdnpasirsalam.sch.id">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-600 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2.5 text-xs text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-[#0284c7] focus:outline-none transition-all placeholder:text-slate-300"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-500">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#0284c7] focus:ring-0">
                        Ingat saya
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-[#0284c7] hover:bg-[#0369a1] text-white text-xs font-bold rounded-xl shadow-md shadow-sky-100 transition-all uppercase tracking-wider mt-2">
                    MASUK
                </button>
            </form>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="py-4 text-center text-xs text-slate-400">
        Copyright © {{ date('Y') }} SDN PASIRSALAM. All rights reserved.
    </footer>

</body>
</html>
