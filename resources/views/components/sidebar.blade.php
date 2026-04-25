@php
    $navItems = [
        [
            'label' => 'Dashboard',
            'href' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
            'disabled' => false,
            // Simpan semua path SVG di sini
            'icon_html' =>
                '<rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/>',
        ],
        [
            'label' => 'Riwayat',
            'href' => '#',
            'active' => false,
            'disabled' => true,
            'icon_html' =>
                '<path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/>',
        ],
        [
            'label' => 'Profile',
            'href' => route('profile.index'),
            'active' => request()->routeIs('profile.*'),
            'disabled' => false,
            'icon_html' =>
                '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />',
        ],
        [
            'label' => 'Pengaturan',
            'href' => '#',
            'active' => false,
            'disabled' => true,
            'icon_html' =>
                '<path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/>',
        ],
    ];
@endphp


<button @click="sidebarOpen = !sidebarOpen"
    class="fixed left-4 top-4 z-[70] inline-flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-md transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 lg:hidden">
    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<div x-show="sidebarOpen" @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-[1px] lg:hidden" x-transition.opacity></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 flex w-72 transform flex-col border-r border-emerald-100/80 bg-white/95 px-5 pb-5 pt-7 shadow-xl shadow-emerald-900/5 backdrop-blur transition duration-300 ease-out">
    <div class="mb-8 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13c5.333 2 12 .667 18-7M6 16c3.167 1.333 7 .667 11-3M5 19h14" />
                </svg>
            </span>
            <div>
                <p class="text-2xl font-extrabold tracking-tight text-emerald-600">ShareBite</p>
            </div>
        </a>

        <button @click="sidebarOpen = false"
            class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 lg:hidden">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="space-y-1.5">
        @foreach ($navItems as $item)
            <a href="{{ $item['href'] }}" @click="if(window.innerWidth < 1024) sidebarOpen = false"
                @class([
                    'group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition',
                    'bg-emerald-100 text-emerald-800 shadow-sm shadow-emerald-600/5' =>
                        $item['active'],
                    'text-slate-600 hover:bg-slate-100/80 hover:text-slate-800' =>
                        !$item['active'] && !$item['disabled'],
                    'cursor-not-allowed text-slate-400' => $item['disabled'],
                ]) @if ($item['disabled']) aria-disabled="true" @endif>
                <span @class([
                    'inline-flex h-8 w-8 items-center justify-center rounded-lg transition',
                    'bg-emerald-200/70 text-emerald-700' => $item['active'],
                    'bg-slate-100 text-slate-400' => $item['disabled'],
                    'bg-slate-100 text-slate-500 group-hover:bg-slate-200 group-hover:text-slate-700' =>
                        !$item['active'] && !$item['disabled'],
                ])>
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        {!! $item['icon_html'] !!}
                    </svg>
                </span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="mt-auto space-y-3 pt-6">
        <a href="{{ route('profile.index') }}"
            class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-3 transition hover:border-emerald-200 hover:bg-emerald-50/60">
            <span
                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-sm font-semibold text-emerald-700">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </span>
            <span class="min-w-0">
                <span
                    class="block truncate text-sm font-semibold text-slate-800">{{ Auth::user()->name ?? 'Profil' }}</span>
                <span class="block truncate text-xs text-slate-500">{{ Auth::user()->email ?? '' }}</span>
            </span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-100">
                Logout
            </button>
        </form>
    </div>
</aside>
