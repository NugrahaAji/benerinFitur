<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>

                    <h3 class="mt-4 text-lg font-medium text-gray-900">
                        Akun Menunggu Verifikasi
                    </h3>

                    <p class="mt-2 text-sm text-gray-600">
                        Akun Anda saat ini sedang menunggu verifikasi oleh administrator.
                        Anda akan dapat menggunakan sistem setelah akun Anda diverifikasi.
                    </p>

                    <div class="mt-6">
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
