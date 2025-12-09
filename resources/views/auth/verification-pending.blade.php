<x-app-layout>
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 max-w-[1440p] ">
        <div class=" mx-2">
            <div class="bg-gradient-to-b from-slate-600/10 to-black shadow-2xl rounded-lg overflow-hidden border border-zinc-600">
                <!-- Header Section -->
                <div class="px-8 py-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full p-0.5 mb-4">
                        <div class="h-full w-full rounded-full bg-[#ffcc00]/20 flex items-center justify-center">
                            <svg class="h-10 w-10 text-[#ffcc00]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <p class="inline-block px-6 py-2 rounded-full text-xs border border-zinc-600 bg-gradient-to-r from-[#ffcc00] to-[#fff] bg-clip-text text-transparent font-semibold mb-4">
                        SI PANDA - Sistem Pengelolaan Surat
                    </p>

                    <h2 class="text-3xl md:text-4xl font-bold text-white mt-4">
                        Menunggu
                        <span class="bg-gradient-to-r from-[#ffcc00] to-[#fff] bg-clip-text text-transparent">Verifikasi</span>
                    </h2>

                    <p class="text-gray-300 text-sm mt-3 leading-relaxed">
                        Terima kasih telah mendaftar! Akun Anda saat ini sedang menunggu verifikasi dari administrator.
                    </p>
                </div>

                <!-- Content Section -->
                <div class="px-8 pb-8">
                    <!-- User Info Card -->
                    <div class="bg-gradient-to-br from-slate-900/50 to-black border border-zinc-600 rounded-xl p-5 mb-6 shadow-lg">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-zinc-600 to-[#fff] p-0.5 mr-3">
                                    <div class="h-full w-full rounded-full bg-black flex items-center justify-center">
                                        <svg class="h-5 w-5 text-[#ffcc00]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-[#ffcc00] uppercase tracking-wide font-semibold">Nama</p>
                                    <p class="text-white font-normal mt-0.5">{{ auth()->user()->name }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-zinc-600 p-[1px] mr-3">
                                    <div class="h-full w-full rounded-full bg-black flex items-center justify-center">
                                        <svg class="h-5 w-5 text-[#ffcc00]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-[#ffcc00] uppercase tracking-wide font-semibold">Email</p>
                                    <p class="text-white font-normal break-all mt-0.5">{{ auth()->user()->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-zinc-600 p-0.5 mr-3">
                                    <div class="h-full w-full rounded-full bg-black flex items-center justify-center">
                                        <svg class="h-5 w-5 text-[#ffcc00]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-[#ffcc00] uppercase tracking-wide font-semibold">Terdaftar</p>
                                    <p class="text-white font-normal mt-0.5">{{ auth()->user()->created_at->format('d F Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info Alert -->
                    <div class="bg-black border border-zinc-600 rounded-xl p-4 mb-6">
                        <div class="flex">
                            <svg class="h-5 w-5 text-[#DFAB9B] mt-0.5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-gray-300 leading-relaxed">
                                Anda akan menerima notifikasi setelah akun Anda diverifikasi oleh admin. Proses ini biasanya memakan waktu <span class="bg-gradient-to-r from-[#ffcc00] to-[#fff] bg-clip-text text-transparent font-semibold">1-2 hari kerja</span>.
                            </p>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full px-12 py-3 rounded-full text-sm font-semibold bg-[#ffcc00] text-black active:scale-95 transition-all shadow-lg hover:shadow-xl flex items-center justify-center group">
                            Kembali
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <div class="bg-zinc-600 px-8 py-4 border-t border-zinc-600">
                    <p class="text-center text-xs text-gray-400">
                        Jika ada kendala, hubungi administrator sistem
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
