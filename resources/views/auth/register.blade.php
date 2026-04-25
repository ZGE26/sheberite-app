<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="role" :value="__('Daftar Sebagai')" />
            <select id="role" name="role"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="individu" {{ old('role') == 'individu' ? 'selected' : '' }}>Individu</option>
                <option value="komunitas" {{ old('role') == 'komunitas' ? 'selected' : '' }}>Komunitas</option>
                <option value="unit_bisnis" {{ old('role') == 'unit_bisnis' ? 'selected' : '' }}>Unit Bisnis</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        {{-- Phone Number --}}
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />

            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')"
                required pattern="[0-9]{10,15}" title="Masukkan nomor telepon yang valid (hanya angka, 10-15 digit)" />

            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        {{-- Main Address --}}
        <div class="mt-4">
            <x-input-label for="city" :value="__('Kota/Kabupaten')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')"
                required />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="district" :value="__('Kecamatan')" />
            <x-text-input id="district" class="block mt-1 w-full" type="text" name="district" :value="old('district')"
                required />
            <x-input-error :messages="$errors->get('district')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('Kode Pos')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                :value="old('postal_code')" required pattern="[0-9]+" title="Hanya masukkan angka" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="full_address" :value="__('Detail Alamat (Nama Jalan, RT/RW, Patokan)')" />
            <textarea id="full_address" name="full_address" rows="3"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>{{ old('full_address') }}</textarea>
            <x-input-error :messages="$errors->get('full_address')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
