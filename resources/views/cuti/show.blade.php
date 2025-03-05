<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Cuti Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-4">
                    <a href="{{ route('cuti.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-200">
                        ← Kembali
                    </a>
                </div>

                <h3 class="text-lg font-semibold mb-2">Nama Pegawai: {{ $pegawai->nama_depan }} {{ $pegawai->nama_belakang }}</h3>

                @foreach ($cutiPerTahun as $tahun => $cutis)
                    <div class="mb-4">
                        <h4 class="text-gray-700 font-semibold mb-1">Tahun {{ $tahun }}</h4>
                        <table class="w-full border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700">
                                    <th class="border p-2">Tanggal Mulai</th>
                                    <th class="border p-2">Tanggal Selesai</th>
                                    <th class="border p-2">Alasan</th>
                                    <th class="border p-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cutis as $cuti)
                                    <tr>
                                        <td class="border p-2">{{ $cuti->tanggal_mulai }}</td>
                                        <td class="border p-2">{{ $cuti->tanggal_selesai }}</td>
                                        <td class="border p-2">{{ $cuti->alasan }}</td>
                                        <td class="border p-2 text-center">
                                            <a href="{{ route('cuti.edit', $cuti->id) }}" class="text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M17.414 2.586a2 2 0 0 1 0 2.828l-10 10A2 2 0 0 1 6 16H4a1 1 0 0 1-1-1v-2a2 2 0 0 1 .586-1.414l10-10a2 2 0 0 1 2.828 0zM15 5l-1-1-9 9V14h1l9-9z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('cuti.destroy', $cuti->id) }}" method="POST" class="inline">
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
                @endforeach

                @if ($cutiPerTahun->isEmpty())
                    <span class="text-gray-500">Tidak ada cuti</span>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
