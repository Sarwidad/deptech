<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data Cuti
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
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
                <form action="{{ route('cuti.update', $cuti->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Pegawai -->
                    <div class="mb-4">
                        <label for="pegawai_id" class="block text-sm font-medium text-gray-700">Nama Pegawai</label>
                        <select name="pegawai_id" id="pegawai_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="" disabled selected>--Pilih Nama Pegawai--</option>
                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}" {{ $pegawai->id == $cuti->pegawai_id ? 'selected' : '' }}>
                                    {{ $pegawai->nama_depan }} {{ $pegawai->nama_belakang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Alasan -->
                    <div class="mb-4">
                        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Cuti</label>
                        <textarea name="alasan" id="alasan" class="w-full border-gray-300 rounded-md shadow-sm">{{ $cuti->alasan }}</textarea>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-4">
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $cuti->tanggal_mulai }}">
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-4">
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $cuti->tanggal_selesai }}">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Update
                    </button>
                    <a href="{{ route('cuti.index') }}" class="ml-4 text-gray-600">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
