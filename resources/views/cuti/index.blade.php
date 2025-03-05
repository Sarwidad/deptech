<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Cuti Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Tombol Tambah Data -->
                <div class="mb-4">
                    <a href="{{ route('cuti.create') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                        + Tambah Data
                    </a>
                </div>
                                <!-- Pesan Sukses -->
                                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Pesan Error -->
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="border p-2">Nama Pegawai</th>
                                <th class="border p-2">Email</th>
                                <th class="border p-2">No HP</th>
                                <th class="border p-2">Alamat</th>
                                <th class="border p-2">Jenis Kelamin</th>
                                <th class="border p-2">Total Hari Cuti</th>
                                <th class="border p-2">Detail Cuti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawais as $pegawai)
                                <tr>
                                    <td class="border p-2">{{ $pegawai->nama_depan }} {{ $pegawai->nama_belakang }}</td>
                                    <td class="border p-2">{{ $pegawai->email }}</td>
                                    <td class="border p-2">{{ $pegawai->no_hp }}</td>
                                    <td class="border p-2">{{ $pegawai->alamat }}</td>
                                    <td class="border p-2">{{ $pegawai->jenis_kelamin }}</td>
                                    <td class="border p-2">
                                        @if (isset($cutiPerTahun[$pegawai->id]) && $cutiPerTahun[$pegawai->id]->isNotEmpty())
                                            @foreach ($cutiPerTahun[$pegawai->id] as $tahun => $cutis)
                                                <div><strong>{{ $tahun }}:</strong> 
                                                    {{ $cutis->sum(function($cuti) { 
                                                        return \Carbon\Carbon::parse($cuti->tanggal_mulai)
                                                            ->diffInDays($cuti->tanggal_selesai) + 1; 
                                                    }) }} hari
                                                </div>
                                            @endforeach
                                        @else
                                            <span class="text-gray-500">Tidak ada cuti</span>
                                        @endif
                                    </td>
                                    <td class="border p-2 text-center">
                                        <a href="{{ route('cuti.show', $pegawai->id) }}" class="text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 3a7 7 0 1 0 0 14A7 7 0 0 0 10 3zM2 10a8 8 0 1 1 16 0A8 8 0 0 1 2 10z" />
                                                <path d="M10 7a3 3 0 1 1 0 6 3 3 0 0 1 0-6z" />
                                            </svg>
                                        </a>
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
