<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Tombol Tambah Data -->
                <div class="mb-4">
                    <a href="{{ route('users.create') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                        + Tambah Admin
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                            <th class="border p-2">ID</th>
                                <th class="border p-2">Nama Admin</th>
                                <th class="border p-2 ">Email</th>
                                <th class="border p-2 ">Tanggal Lahir</th>
                                <th class="border p-2">Jenis Kelamin</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="text-gray-800">
                                    <td class="border p-2">{{ $user->id }}</td>
                                    <td class="border p-2">{{ $user->nama_depan }} {{ $user->nama_belakang }}</td>
                                    <td class="border p-2">{{ $user->email }}</td>
                                    <td class="border p-2">{{ $user->tanggal_lahir }}</td>
                                    <td class="border p-2">{{ $user->jenis_kelamin }}</td>
                                    <td class="border p-2 text-center">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 8a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V8zm5-4a1 1 0 0 1 1 1V5h2a1 1 0 1 1 0 2H6a1 1 0 1 1 0-2h2V5a1 1 0 0 1 1-1h2z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>