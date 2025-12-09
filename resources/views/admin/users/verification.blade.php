<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white/80 leading-tight">
                {{ __('Verifikasi User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[1440px] mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-green-800/40 border border-green-400/20 text-green-500 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-800/40 border border-red-400/20 text-red-500 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Pending Users Table -->
            <div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-white">User Menunggu Verifikasi ({{ $pendingUsers->count() }})</h3>

                    @if($pendingUsers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-600">
                                <thead class="bg-zinc-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Terdaftar</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-600">
                                    @foreach($pendingUsers as $user)
                                        <tr class="hover:bg-zinc-800/50">
                                            <td class="px-6 py-4 text-sm text-white">{{ $user->name }}</td>
                                            <td class="px-6 py-4 text-sm text-white">{{ $user->email }}</td>
                                            <td class="px-6 py-4 text-sm">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-500/20 text-blue-400">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white whitespace-nowrap">
                                                {{ $user->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                <form action="{{ route('admin.users.verify', $user) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-green-600/20 hover:bg-green-600/30 text-green-400 hover:text-green-300 font-semibold py-2 px-4 rounded transition">
                                                        Verifikasi
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Tidak ada user yang menunggu verifikasi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
