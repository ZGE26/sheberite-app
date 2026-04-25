<x-app-layout :backUrl="route('profile.edit')">
    <x-slot name="header">
        <h2 class="text-2xl font-bold tracking-tight text-emerald-900">
            Ubah Kata Sandi
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8 px-6 sm:px-10 bg-white rounded-[2rem] shadow-sm">

        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-[#166534] mb-3">Ubah Kata Sandi</h2>
            <p class="text-sm text-gray-500 max-w-md mx-auto">
                Keamanan akun Anda adalah prioritas kami. Pastikan kata sandi baru Anda kuat, unik, dan tidak mudah
                ditebak oleh orang lain.
            </p>
        </div>

        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
                <label for="current_password"
                    class="block text-xs font-bold text-gray-500 tracking-wide mb-2 uppercase">Kata Sandi Lama</label>
                <div class="relative">
                    <input id="current_password" name="current_password" type="password"
                        class="block w-full bg-[#F3F4F6] border-0 rounded-xl py-3.5 px-4 text-gray-900 focus:ring-2 focus:ring-[#22C55E] transition"
                        required>
                    <button type="button"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-gray-500 tracking-wide mb-2 uppercase">Kata
                    Sandi Baru</label>
                <div class="relative">
                    <input id="password" name="password" type="password"
                        class="block w-full bg-[#F3F4F6] border-0 rounded-xl py-3.5 px-4 text-gray-900 focus:ring-2 focus:ring-[#22C55E] transition"
                        required>
                    <button type="button"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center gap-2 mt-3">
                    <div class="flex-1 h-1.5 rounded-full bg-gray-200 transition-colors duration-300"></div>
                    <div class="flex-1 h-1.5 rounded-full bg-gray-200 transition-colors duration-300"></div>
                    <div class="flex-1 h-1.5 rounded-full bg-gray-200 transition-colors duration-300"></div>
                    <div class="flex-1 h-1.5 rounded-full bg-gray-200 transition-colors duration-300"></div>
                    <span id="strength-text" class="text-[10px] font-bold ml-2 tracking-wider w-12 text-center"></span>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation"
                    class="block text-xs font-bold text-gray-500 tracking-wide mb-2 uppercase">Konfirmasi Kata Sandi
                    Baru</label>
                <div class="relative">
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        class="block w-full bg-[#F3F4F6] border-0 rounded-xl py-3.5 px-4 text-gray-900 focus:ring-2 focus:ring-[#22C55E] transition"
                        required>
                    <button type="button"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit"
                    class="flex-1 bg-[#22C55E] hover:bg-green-600 text-white font-bold py-3.5 px-4 rounded-xl transition shadow-sm">
                    Simpan Kata Sandi
                </button>
                <a href="{{ route('profile.edit') }}"
                    class="flex-1 bg-[#EBEFEA] hover:bg-gray-300 text-[#4B5563] font-bold py-3.5 px-4 rounded-xl text-center transition">
                    Batal
                </a>
            </div>
        </form>

        <div class="mt-8 bg-[#F4FDF6] rounded-2xl p-5 flex items-start gap-4">
            <div class="mt-0.5 text-[#166534]">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-1.998A11.954 11.954 0 0110 1.944zM10 14a4 4 0 100-8 4 4 0 000 8zm-2-4a2 2 0 114 0 2 2 0 01-4 0z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-bold text-gray-500 tracking-wider mb-1 uppercase">Tips Keamanan</h4>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Gunakan kombinasi huruf besar, kecil, angka, dan simbol untuk membuat kata sandi yang lebih aman.
                    Hindari menggunakan informasi pribadi seperti tanggal lahir.
                </p>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('button[type="button"]');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const iconPath = this.querySelector('path:first-child');
                    if (input.type === 'password') {
                        input.type = 'text';
                        iconPath.setAttribute('d',
                            'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18'
                        );
                    } else {
                        input.type = 'password';
                        iconPath.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z');
                    }
                });
            });

            const passwordInput = document.getElementById('password');
            const strengthBars = document.querySelectorAll('.flex-1.h-1\\.5');
            const strengthText = document.getElementById('strength-text');

            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const val = this.value;
                    let strength = 0;

                    strengthBars.forEach(bar => {
                        bar.className =
                            'flex-1 h-1.5 rounded-full bg-gray-200 transition-colors duration-300';
                    });

                    if (val.length === 0) {
                        strengthText.textContent = '';
                        return;
                    }

                    if (val.length >= 8) strength += 1;
                    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) strength += 1;
                    if (/[0-9]/.test(val)) strength += 1;
                    if (/[^A-Za-z0-9]/.test(val)) strength += 1;

                    if (strength <= 1) {
                        strengthBars[0].classList.replace('bg-gray-200', 'bg-red-500');
                        strengthText.textContent = 'LEMAH';
                        strengthText.className =
                            'text-[10px] font-bold text-red-500 ml-2 tracking-wider w-12 text-center';
                    } else if (strength === 2 || strength === 3) {
                        strengthBars[0].classList.replace('bg-gray-200', 'bg-[#22C55E]');
                        strengthBars[1].classList.replace('bg-gray-200', 'bg-[#22C55E]');
                        if (strength === 3) strengthBars[2].classList.replace('bg-gray-200',
                            'bg-[#22C55E]');
                        strengthText.textContent = 'SEDANG';
                        strengthText.className =
                            'text-[10px] font-bold text-[#22C55E] ml-2 tracking-wider w-12 text-center';
                    } else if (strength >= 4) {
                        strengthBars.forEach(bar => bar.classList.replace('bg-gray-200', 'bg-[#22C55E]'));
                        strengthText.textContent = 'KUAT';
                        strengthText.className =
                            'text-[10px] font-bold text-[#22C55E] ml-2 tracking-wider w-12 text-center';
                    }
                });
            }

            @if ($errors->updatePassword->has('current_password'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Kata sandi lama yang Anda masukkan tidak sesuai.',
                    confirmButtonColor: '#EF4444',
                    confirmButtonText: 'Coba Lagi',
                    customClass: {
                        popup: 'rounded-2xl',
                    }
                });
            @endif

            @if (session('status') === 'password-updated')
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Kata sandi Anda berhasil diperbarui.',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    customClass: {
                        popup: 'rounded-2xl',
                    },
                    willClose: () => {
                        window.location.replace("{{ route('profile.index') }}");
                    }
                });
            @endif
        });
    </script>
</x-app-layout>
