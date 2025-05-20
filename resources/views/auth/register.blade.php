<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
        <h1 class="text-xl font-bold text-center mb-6">📝 Register</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Nama</label>
                <input type="text" name="name" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block font-semibold">Password</label>
                <input type="password" name="password" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block font-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Daftar</button>
        </form>

        <p class="mt-4 text-sm text-center">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>
</x-guest-layout>
