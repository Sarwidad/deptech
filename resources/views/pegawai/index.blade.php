<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Tombol Tambah Data -->
                <div class="mb-4">
                    <a href="{{ route('pegawai.create') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                        + Tambah Data
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="border p-2">ID</th>
                                <th class="border p-2">Nama Pegawai</th>
                                <th class="border p-2 ">Email</th>
                                <th class="border p-2 ">No. HP</th>
                                <th class="border p-2 ">Alamat</th>
                                <th class="border p-2">Jenis Kelamin</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawais as $pegawai)
                                <tr class="text-gray-800">
                                    <td class="border p-2">{{ $pegawai->id }}</td>
                                    <td class="border p-2">{{ $pegawai->nama_depan }} {{ $pegawai->nama_belakang }}</td>
                                    <td class="border p-2 ">{{ $pegawai->email }}</td>
                                    <td class="border p-2 ">{{ $pegawai->no_hp }}</td>
                                    <td class="border p-2 ">{{ $pegawai->alamat }}</td>
                                    <td class="border p-2">{{ $pegawai->jenis_kelamin }}</td>
                                    <td class="border p-2 text-center">
                                        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 0 1 0 2.828l-10 10A2 2 0 0 1 6 16H4a1 1 0 0 1-1-1v-2a2 2 0 0 1 .586-1.414l10-10a2 2 0 0 1 2.828 0zM15 5l-1-1-9 9V14h1l9-9z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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