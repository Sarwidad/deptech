<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <form method="post" action="{{ route('users.store') }}" class="mt-6 space-y-6">
                    @csrf

                    <!-- Nama Depan -->
                    <div>
                        <x-input-label for="nama_depan" :value="__('Nama Depan')" />
                        <x-text-input id="nama_depan" name="nama_depan" type="text" class="mt-1 block w-full" :value="old('nama_depan')" required autofocus autocomplete="given-name" />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_depan')" />
                    </div>

                    <!-- Nama Belakang -->
                    <div>
                        <x-input-label for="nama_belakang" :value="__('Nama Belakang')" />
                        <x-text-input id="nama_belakang" name="nama_belakang" type="text" class="mt-1 block w-full" :value="old('nama_belakang')" required autocomplete="family-name" />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_belakang')" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                        <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                        <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                        <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                        <a href="{{ route('users.index') }}" class="ml-4 text-gray-600">Batal</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
