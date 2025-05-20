<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
        <h1 class="text-xl font-bold text-center mb-6">🔐 Login</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" required autofocus
                       class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block font-semibold">Password</label>
                <input type="password" name="password" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Forgot?</a>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Login</button>
        </form>

        <p class="mt-4 text-sm text-center">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Daftar</a>
        </p>
    </div>
</x-guest-layout>
