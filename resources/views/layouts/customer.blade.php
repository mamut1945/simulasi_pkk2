<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

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
    <main class="py-6">
        @yield('content')
    </main>

</body>
</html>
