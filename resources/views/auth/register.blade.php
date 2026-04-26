<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div x-data="{
            role: @js(old('role', 'individu')),
            agreed: false,
            name: @js(old('name', '')),
            email: @js(old('email', '')),
            phone: @js(old('phone', '')),
            password: '',
            password_confirmation: '',
            community_name: @js(old('community_name', '')),
            business_name: @js(old('business_name', '')),
            category: @js(old('category', 'Restoran')),
            hasFile: false,
            /* Diganti: Khusus mengecek apakah file NIB sudah diupload */
            city: @js(old('city', '')),
            district: @js(old('district', '')),
            postal_code: @js(old('postal_code', '')),
            full_address: @js(old('full_address', '')),
        
            get isFormValid() {
                // 1. Cek data umum
                if (!this.agreed || !this.name || !this.email || !this.phone || !this.password || !this.password_confirmation) return false;
        
                // 2. Cek khusus Komunitas
                if (this.role === 'komunitas' && !this.community_name) return false;
        
                // 3. Cek khusus Unit Bisnis (Termasuk cek file)
                if (this.role === 'unit_bisnis' && (!this.business_name || !this.category || !this.hasFile)) return false;
        
                // 4. Cek Alamat (Jika bukan unit bisnis)
                if (this.role !== 'unit_bisnis' && (!this.city || !this.district || !this.postal_code || !this.full_address)) return false;
        
                return true;
            }
        }">

            <input type="hidden" name="role" x-model="role">

            <div class="flex bg-gray-200 rounded-lg p-1 mb-6">
                <button type="button" @click="role = 'unit_bisnis'"
                    :class="role === 'unit_bisnis' ? 'bg-green-500 text-white shadow' : 'text-gray-600 hover:text-gray-800'"
                    class="flex-1 py-2 rounded-md text-sm font-medium transition-all duration-200">
                    Unit Bisnis
                </button>
                <button type="button" @click="role = 'komunitas'"
                    :class="role === 'komunitas' ? 'bg-green-500 text-white shadow' : 'text-gray-600 hover:text-gray-800'"
                    class="flex-1 py-2 rounded-md text-sm font-medium transition-all duration-200">
                    Komunitas
                </button>
                <button type="button" @click="role = 'individu'"
                    :class="role === 'individu' ? 'bg-green-500 text-white shadow' : 'text-gray-600 hover:text-gray-800'"
                    class="flex-1 py-2 rounded-md text-sm font-medium transition-all duration-200">
                    Individu
                </button>
            </div>

            <div>
                <x-input-label for="name">
                    <span
                        x-text="(role === 'komunitas' || role === 'unit_bisnis') ? 'Nama Penanggung Jawab (Sesuai KTP)' : 'Nama Lengkap'"></span>
                </x-input-label>
                <x-text-input id="name" x-model="name" class="block mt-1 w-full bg-gray-50" type="text"
                    name="name" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div x-show="role === 'komunitas'" x-collapse class="mt-4 space-y-4">
                <div>
                    <x-input-label for="community_name" :value="__('Nama Komunitas/Akun')" />
                    <x-text-input id="community_name" x-model="community_name" x-bind:required="role === 'komunitas'"
                        class="block mt-1 w-full bg-gray-50" type="text" name="community_name"
                        placeholder="Contoh: Komunitas Hijau Lestari" />
                    <x-input-error :messages="$errors->get('community_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="bio_community" :value="__('Bio Komunitas (Opsional)')" />
                    <textarea id="bio_community" name="bio_community" rows="2"
                        class="block mt-1 w-full border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm">{{ old('bio_community') }}</textarea>
                </div>
            </div>

            <div x-show="role === 'unit_bisnis'" x-collapse class="mt-4 space-y-4">
                <div>
                    <x-input-label for="business_name" :value="__('Nama Usaha')" />
                    <x-text-input id="business_name" x-model="business_name" x-bind:required="role === 'unit_bisnis'"
                        class="block mt-1 w-full bg-gray-50" type="text" name="business_name"
                        placeholder="Contoh: Resto Lestari" />
                    <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="category" :value="__('Jenis Usaha')" />
                    <select id="category" x-model="category" :required="role === 'unit_bisnis'" name="category"
                        class="block mt-1 w-full border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm">
                        <option value="Restoran">Restoran</option>
                        <option value="Cafe">Cafe</option>
                        <option value="Warung Makan">Warung Makan</option>
                        <option value="Katering">Katering</option>
                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                <div class="p-4 border-2 border-dashed border-green-300 rounded-lg bg-green-50 text-center">
                    <x-input-label for="nib_file" value="Upload Nomor Induk Berusaha (NIB)"
                        class="font-bold text-gray-700" />
                    <p class="text-xs text-gray-500 mb-2">Format PDF(Maks. 5MB)</p>

                    <input type="file" id="nib_file" name="nib_file" accept=".pdf"
                        :required="role === 'unit_bisnis'" @change="hasFile = $event.target.files.length > 0"
                        class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200" />

                    <x-input-error :messages="$errors->get('nib_file')" class="mt-2" />
                </div>
            </div>

            <hr class="my-6 border-gray-200">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="phone" :value="__('Nomor HP')" />
                    <x-text-input id="phone" x-model="phone" class="block mt-1 w-full bg-gray-50" type="tel"
                        name="phone" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="email">
                        <span x-text="role === 'unit_bisnis' ? 'Email Bisnis' : 'Email'"></span>
                    </x-input-label>
                    <x-text-input id="email" x-model="email" class="block mt-1 w-full bg-gray-50" type="email"
                        name="email" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div x-show="role !== 'unit_bisnis'" x-collapse>
                <h3 class="text-lg font-medium text-gray-900 mt-6 mb-2">Lokasi & Alamat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                    <div>
                        <x-input-label for="city" :value="__('Kota/Kabupaten')" />
                        <x-text-input id="city" x-model="city" x-bind:required="role !== 'unit_bisnis'"
                            class="block mt-1 w-full bg-gray-50" type="text" name="city" />
                    </div>
                    <div>
                        <x-input-label for="district" :value="__('Kecamatan')" />
                        <x-text-input id="district" x-model="district" x-bind:required="role !== 'unit_bisnis'"
                            class="block mt-1 w-full bg-gray-50" type="text" name="district" />
                    </div>
                    <div>
                        <x-input-label for="postal_code" :value="__('Kode Pos')" />
                        <x-text-input id="postal_code" x-model="postal_code" x-bind:required="role !== 'unit_bisnis'"
                            class="block mt-1 w-full bg-gray-50" type="text" name="postal_code" />
                    </div>
                </div>
                <div class="mt-4">
                    <x-input-label for="full_address" :value="__('Detail Alamat (Jalan, RT/RW, Patokan)')" />
                    <textarea id="full_address" x-model="full_address" :required="role !== 'unit_bisnis'" name="full_address"
                        rows="3"
                        class="block mt-1 w-full border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <div>
                    <x-input-label for="password" :value="__('Kata Sandi')" />
                    <x-text-input id="password" x-model="password" class="block mt-1 w-full bg-gray-50"
                        type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Sandi')" />
                    <x-text-input id="password_confirmation" x-model="password_confirmation"
                        class="block mt-1 w-full bg-gray-50" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex items-start p-4 bg-gray-50 border border-gray-200 rounded-lg">
                <input id="terms" type="checkbox" x-model="agreed" required
                    class="w-4 h-4 mt-1 text-green-600 border-gray-300 rounded focus:ring-green-500">
                <label for="terms" class="ml-2 text-sm text-gray-600">
                    Saya bersedia mengikuti regulasi dan peraturan yang ada serta berkomitmen pada standar keamanan
                    pangan <span class="font-bold text-green-600">ShareBite</span> secara konsisten.
                </label>
            </div>

            <div class="mt-6">
                <button type="submit" :disabled="!isFormValid"
                    :class="isFormValid ? 'bg-green-500 hover:bg-green-600 cursor-pointer' :
                        'bg-gray-400 cursor-not-allowed opacity-70'"
                    class="w-full text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                    Daftar Sekarang
                </button>
            </div>

            <div class="mt-4 text-center">
                <a class="text-sm text-gray-600 hover:text-green-600" href="{{ route('login') }}">
                    Sudah memiliki akun mitra? <span class="font-bold">Masuk ke Dashboard</span>
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
