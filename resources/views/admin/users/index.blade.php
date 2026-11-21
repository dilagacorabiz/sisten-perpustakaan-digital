
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Pengguna
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="p-3">Nama</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="p-3">{{ $user->name }}</td>
                                <td class="p-3">{{ $user->email }}</td>

                                <td class="p-3">
                                    {{ $user->getRoleNames()->implode(', ') ?: 'Belum ada role' }}
                                </td>

                                <td class="p-3">
                                    <form method="POST"
                                        action="{{ route('admin.users.role', $user) }}">
                                        @csrf
                                        @method('PATCH')

                                        <select name="role" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    @selected($user->hasRole($role->name))>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button type="submit"
                                            class="px-3 py-1 bg-blue-600 text-white rounded">
                                            Ubah Role
                                        </button>
                                    </form>

                                    @if ($user->id !== auth()->id())
                                        <form method="POST"
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="mt-2 px-3 py-1 bg-red-600 text-white rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>