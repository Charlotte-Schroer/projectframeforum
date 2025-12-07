<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FrameForum') }} - @yield('title', 'Frame Forum')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
<div class="min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">
                            🎬 FrameForum
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('/') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                            Home
                        </a>
                        <a href="{{ route('news.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('news.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                            News
                        </a>
                        <a href="{{ route('forum.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('forum.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                            Forum
                        </a>
                        <a href="{{ route('faq.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('faq.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                            FAQ
                        </a>
                        <a href="{{ route('contact.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('contact.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                            Contact
                        </a>
                    </div>
                </div>

                <!-- Right Side Navigation -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                        <!-- Admin Link -->
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 hover:text-indigo-600 mr-4">
                                Admin Panel
                            </a>
                        @endif

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                <div>{{ Auth::user()->username }}</div>
                                <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                <a href="{{ route('profile.show', auth()->user()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    My Profile
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Configuration
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-indigo-600 mr-4">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Register
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden" x-data="{ mobileOpen: false }">
                    <button @click="mobileOpen = !mobileOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Mobile Navigation Menu -->
                    <div x-show="mobileOpen" @click.away="mobileOpen = false" x-cloak class="fixed inset-0 z-40 sm:hidden">
                        <div class="fixed inset-0 bg-black bg-opacity-25" @click="mobileOpen = false"></div>
                        <div class="fixed top-0 right-0 w-full max-w-sm bg-white h-full shadow-xl z-50">
                            <div class="p-6">
                                <button @click="mobileOpen = false" class="mb-4 text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <div class="space-y-1">
                                    <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50' }}">
                                        Home
                                    </a>
                                    <a href="{{ route('news.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('news.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50' }}">
                                        News
                                    </a>
                                    <a href="{{ route('forum.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('forum.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50' }}">
                                        Forum
                                    </a>
                                    <a href="{{ route('faq.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('faq.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50' }}">
                                        FAQ
                                    </a>
                                    <a href="{{ route('contact.create') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('contact.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50' }}">
                                        Contact
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-500 text-sm">
                    © {{ date('Y') }} FrameForum. All rights reserved.
                </div>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('faq.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">FAQ</a>
                    <a href="{{ route('contact.create') }}" class="text-gray-500 hover:text-gray-700 text-sm">Contact</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
</body>
</html>
