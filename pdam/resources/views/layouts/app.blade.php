<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EcoWater') }} - @yield('title')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-sky-600 dark:text-sky-400">
                        💧 EcoWater
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden md:flex md:items-center md:space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium whitespace-nowrap">
                        {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium whitespace-nowrap">
                        {{ __('messages.about') }}
                    </a>
                    <a href="{{ route('tariff') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium whitespace-nowrap">
                        {{ __('messages.tariff') }}
                    </a>
                    <a href="{{ route('bill-simulator') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium whitespace-nowrap">
                        {{ __('messages.bill_simulator') }}
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium whitespace-nowrap">
                        {{ __('messages.contact') }}
                    </a>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4">
                    <!-- Language Switcher -->
                    <div class="flex items-center space-x-2 border-r pr-4 dark:border-gray-700">
                        <a href="{{ route('locale.set', 'en') }}" 
                           class="px-3 py-1 rounded {{ app()->getLocale() == 'en' ? 'bg-sky-100 text-sky-600 dark:bg-sky-900 dark:text-sky-300' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            🇬🇧 EN
                        </a>
                        <a href="{{ route('locale.set', 'id') }}" 
                           class="px-3 py-1 rounded {{ app()->getLocale() == 'id' ? 'bg-sky-100 text-sky-600 dark:bg-sky-900 dark:text-sky-300' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            🇮🇩 ID
                        </a>
                    </div>

                    <!-- Auth Links -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                            {{ __('messages.dashboard') }}
                        </a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 px-3 py-2 text-sm font-medium">
                                {{ __('messages.admin_panel') }}
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 text-sm font-medium">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 px-3 py-2 text-sm font-medium">
                            {{ __('messages.login') }}
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            {{ __('messages.register') }}
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="mobile-menu-button text-gray-700 dark:text-gray-300 hover:text-sky-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden bg-white dark:bg-gray-800 border-t dark:border-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded">{{ __('messages.about') }}</a>
                <a href="{{ route('tariff') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded">{{ __('messages.tariff') }}</a>
                <a href="{{ route('bill-simulator') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded">{{ __('messages.bill_simulator') }}</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-sky-50 dark:hover:bg-gray-700 rounded">{{ __('messages.contact') }}</a>
            </div>
        </div>
    </nav>

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded fade-in-up" role="alert">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded fade-in-up" role="alert">
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded fade-in-up" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="py-12">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">💧 EcoWater</h3>
                    <p class="text-gray-400">{{ __('pages.about_description') }}</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">{{ __('messages.contact') }}</h4>
                    <p class="text-gray-400">Email: info@ecowater.local</p>
                    <p class="text-gray-400">Phone: +62 123 456 7890</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('tariff') }}" class="text-gray-400 hover:text-white">{{ __('messages.tariff') }}</a></li>
                        <li><a href="{{ route('bill-simulator') }}" class="text-gray-400 hover:text-white">{{ __('messages.bill_simulator') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} EcoWater. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile menu toggle script -->
    <script>
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    <!-- Toast Notification -->
    <div x-data="{ show: false, message: '', type: 'info' }" 
         @notify.window="show = true; message = $event.detail.message; type = $event.detail.type || 'info'; setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2"
         class="fixed bottom-4 right-4 z-50 pointer-events-none"
         style="display: none;">
        
        <div class="pointer-events-auto rounded-lg shadow-lg p-4 min-w-[300px]"
             :class="{
                'bg-green-500 text-white': type === 'success',
                'bg-red-500 text-white': type === 'error',
                'bg-blue-500 text-white': type === 'info',
                'bg-gray-800 text-white': type === 'warning'
             }">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span x-show="type === 'success'" class="mr-2">✓</span>
                    <span x-show="type === 'error'" class="mr-2">✕</span>
                    <span x-show="type === 'info'" class="mr-2">ℹ</span>
                    <span x-text="message" class="font-medium"></span>
                </div>
                <button @click="show = false" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</body>
</html>
