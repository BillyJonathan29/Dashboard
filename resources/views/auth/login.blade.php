<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard Alope</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dark flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-secondary rounded-2xl shadow-2xl border border-slate-700">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Alope<span class="text-primary">Dashboard</span></h1>
            <p class="text-slate-400 mt-2">Silakan masuk ke akun Anda</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-slate-300 mb-2 text-sm">Alamat Email</label>
                <input type="email" name="email"
                    class="w-full px-4 py-3 bg-dark border border-slate-600 rounded-xl text-white focus:outline-none focus:border-primary transition-all"
                    placeholder="Masukan email anda" required>
            </div>

            <div class="mb-6">
                <label class="block text-slate-300 mb-2 text-sm">Kata Sandi</label>
                <input type="password" name="password"
                    class="w-full px-4 py-3 bg-dark border border-slate-600 rounded-xl text-white focus:outline-none focus:border-primary transition-all"
                    placeholder="••••••••" required>
            </div>

            <button type="submit"
                class="w-full py-3 bg-primary hover:bg-blue-700 text-white font-semibold rounded-xl transition-all shadow-lg shadow-blue-500/30">
                Login
            </button>
        </form>

        <p class="text-center text-slate-500 text-sm mt-8">
            &copy; {{ date('Y') }} Dashboard-alope. All rights reserved.
        </p>
    </div>

</body>

</html>
