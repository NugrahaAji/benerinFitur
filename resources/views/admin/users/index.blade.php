<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white/80 leading-tight">
                {{ __('Manajemen User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[1440px] mx-auto sm:px-6 lg:px-8">
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

            <!-- Tabs Navigation -->
            <div class="border-b border-gray-700 mb-6">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                    <li class="me-2">
                        <button
                            onclick="showTab('semua')"
                            id="tab-semua"
                            class="inline-flex items-center justify-center p-4 border-b-2 border-[#ffcc00] text-[#ffcc00] rounded-t-lg font-semibold">
                            Semua User
                        </button>
                    </li>
                    <li class="me-2">
                        <button
                            onclick="showTab('verified')"
                            id="tab-verified"
                            class="inline-flex items-center justify-center p-4 border-b-2 border-transparent text-white/60 rounded-t-lg font-semibold hover:text-[#ffcc00]">
                            User Terverifikasi
                        </button>
                    </li>
                    <li class="me-2">
                        <button
                            onclick="showTab('pending')"
                            id="tab-pending"
                            class="inline-flex items-center justify-center p-4 border-b-2 border-transparent text-white/60 rounded-t-lg font-semibold hover:text-[#ffcc00]">
                            User Pending
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Content Semua User -->
            <div id="content-semua" class="tab-panel">
                <div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @if($users->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-600">
                                    <thead class="bg-zinc-800">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Nama</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Role</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Terdaftar</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-600">
                                        @foreach($users as $user)
                                            <tr class="hover:bg-zinc-800/50">
                                                <td class="px-6 py-4 text-sm text-white">{{ $user->name }}</td>
                                                <td class="px-6 py-4 text-sm text-white">{{ $user->email }}</td>
                                                <td class="px-6 py-4 text-sm">
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-500/20 text-blue-400">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm">
                                                    @if($user->is_verified)
                                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/20 text-green-400">
                                                            Terverifikasi
                                                        </span>
                                                    @else
                                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500/20 text-yellow-400">
                                                            Pending
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-sm text-white whitespace-nowrap">
                                                    {{ $user->created_at->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm">
                                                    <div class="flex items-center gap-3">
                                                        @if(!$user->is_verified && $user->role !== 'admin')
                                                            <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="inline">
                                                                @csrf
                                                                <button type="submit" class="text-green-400 hover:text-green-300">
                                                                    Verifikasi
                                                                </button>
                                                            </form>
                                                        @endif

                                                        @if($user->role !== 'admin')
                                                            <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" class="inline">
                                                                @csrf
                                                                <button type="submit" class="text-yellow-400 hover:text-yellow-300">
                                                                    {{ $user->is_verified ? 'Nonaktifkan' : 'Aktifkan' }}
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @else
                                                            <span class="text-gray-500 text-xs">Admin</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">Tidak ada user</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content User Terverifikasi -->
            <div id="content-verified" class="tab-panel">
                <div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @php
                            $verifiedUsers = $users->where('is_verified', true);
                        @endphp

                        @if($verifiedUsers->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-600">
                                    <thead class="bg-zinc-800">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Nama</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Role</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Diverifikasi</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-600">
                                        @foreach($verifiedUsers as $user)
                                            <tr class="hover:bg-zinc-800/50">
                                                <td class="px-6 py-4 text-sm text-white">{{ $user->name }}</td>
                                                <td class="px-6 py-4 text-sm text-white">{{ $user->email }}</td>
                                                <td class="px-6 py-4 text-sm">
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-500/20 text-blue-400">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-white whitespace-nowrap">
                                                    {{ $user->verified_at ? $user->verified_at->format('d/m/Y H:i') : '-' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm">
                                                    @if($user->role !== 'admin')
                                                        <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="text-yellow-400 hover:text-yellow-300">
                                                                Nonaktifkan
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-gray-500 text-xs">Admin</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">Tidak ada user terverifikasi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content User Pending -->
            <div id="content-pending" class="tab-panel">
                <div class="bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @php
                            $pendingUsers = $users->where('is_verified', false)->where('role', '!=', 'admin');
                        @endphp

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
                                                    <div class="flex items-center gap-3">
                                                        <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="text-green-400 hover:text-green-300">
                                                                Verifikasi
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Yakin ingin menolak user ini?')">
                                                                Tolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">Tidak ada user yang menunggu verifikasi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
function showTab(tabName) {
    // Hide all panels
    const panels = document.querySelectorAll('.tab-panel');
    panels.forEach(panel => {
        panel.classList.add('hidden');
    });

    // Remove active from all buttons
    const buttons = document.querySelectorAll('[id^="tab-"]');
    buttons.forEach(button => {
        button.classList.remove('border-[#ffcc00]', 'text-[#ffcc00]');
        button.classList.add('border-transparent', 'text-white/60');
    });

    // Show selected panel
    document.getElementById('content-' + tabName).classList.remove('hidden');

    // Activate selected button
    const activeButton = document.getElementById('tab-' + tabName);
    activeButton.classList.remove('border-transparent', 'text-white/60');
    activeButton.classList.add('border-[#ffcc00]', 'text-[#ffcc00]');

    // Save to localStorage
    localStorage.setItem('activeTabUsers', tabName);
}

// Load saved tab on page load
window.addEventListener('DOMContentLoaded', function() {
    const savedTab = localStorage.getItem('activeTabUsers') || 'semua';
    showTab(savedTab);
});
</script>
