<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="font-sans antialiased bg-gray-100">

    <!-- HEADER -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-full mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-black rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">S</span>
                    </div>
                    <span class="text-xl font-semibold">Hotel App</span>
                </div>

                <!-- right -->
                <div class="flex items-center space-x-4 relative" x-data="{ open: false }">
                    
                    <!-- Foto Profile -->
                    <button @click="open = !open" class="focus:outline-none">
                        <img src="https://i.pravatar.cc/150?img=5" 
                            alt="Profile" 
                            class="w-9 h-9 rounded-full cursor-pointer">
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" 
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-44 w-48 bg-white rounded-xl shadow-lg border border-gray-100 z-50">

                        <div class="px-4 py-3 border-b">
                            <p class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition">
                                Logout
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- BODY -->
    <div class="flex">
        <!-- SIDEBAR -->
        <aside class="w-20 bg-white border-r border-gray-200 min-h-screen">
            <div class="flex flex-col items-center py-6 space-y-6">
                @auth
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('dashboard') }}" >
                                    <button class="p-3 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </button>
                </a>
                <a href="{{ route('kamar.index') }}" >
                                    <button class="p-3 hover:bg-gray-100 rounded-lg">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </button>
                        </a>
                        <a href="{{ route('reservasi.riwayat') }}" >
                                            <button class="p-3 hover:bg-gray-100 rounded-lg">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                        </button>
                        </a>
                    @endif
                    @if(auth()->user()->role === 'pelanggan')
                                    <a href="{{ route('reservasi.index') }}" >
                                    <button class="p-3 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                </button>
                </a>
                    @endif
                @endauth
            </div>
        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div>

</body>

</html>
