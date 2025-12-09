<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8">
            <div class="text-center">
                <!-- Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <!-- Title -->
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    Menunggu Verifikasi
                </h2>

                <!-- Message -->
                <p class="text-gray-600 mb-6">
                    Terima kasih telah mendaftar! Akun Anda saat ini sedang menunggu verifikasi dari administrator.
                </p>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <p class="text-sm text-blue-800">
                        <strong>Nama:</strong> {{ auth()->user()->name }}<br>
                        <strong>Email:</strong> {{ auth()->user()->email }}<br>
                        <strong>Terdaftar:</strong> {{ auth()->user()->created_at->format('d F Y, H:i') }}
                    </p>
                </div>

                <!-- Additional Info -->
                <p class="text-sm text-gray-500 mb-6">
                    Anda akan menerima notifikasi setelah akun Anda diverifikasi oleh admin. Proses ini biasanya memakan waktu 1-2 hari kerja.
                </p>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
