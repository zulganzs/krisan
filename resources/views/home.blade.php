@extends('layouts.app')

@section('title', __('messages.home'))

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-sky-600 to-sky-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center fade-in-up">
            <h1 class= "text-5xl font-bold mb-6">{{ __('pages.hero_title') }}</h1>
            <p class="text-xl mb-8 text-sky-100">{{ __('pages.hero_subtitle') }}</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('bill-simulator') }}" class="bg-white text-sky-600 px-8 py-4 rounded-lg font-semibold hover:bg-sky-50 hover:scale-105 transition-all duration-300 shadow-lg">
                    {{ __('pages.hero_cta') }}
                </a>
                <a href="{{ route('tariff') }}" class="bg-sky-700 text-white px-8 py-4 rounded-lg font-semibold hover:bg-sky-600 transition-all duration-300">
                    {{ __('messages.tariff') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Announcements Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">{{ __('pages.latest_announcements') }}</h2>
    
    @if($announcements->count() > 0)
        <div class="grid grid-cols-1 gap-6">
            @foreach($announcements as $announcement)
                <div class="card fade-in-up">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">{{ $announcement->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ Str::limit($announcement->content, 150) }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-4">{{ $announcement->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="card text-center py-12">
            <p class="text-gray-600 dark:text-gray-400">{{ __('pages.no_announcements') }}</p>
        </div>
    @endif
</div>

<!-- Features Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="card text-center fade-in-up">
            <div class="text-sky-600 text-5xl mb-4">💧</div>
            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">{{ __('messages.tariff') }}</h3>
            <p class="text-gray-600 dark:text-gray-400">Transparent tiered pricing for fair water usage</p>
        </div>
        <div class="card text-center fade-in-up" style="animation-delay: 0.1s;">
            <div class="text-sky-600 text-5xl mb-4">🧮</div>
            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">{{ __('messages.bill_simulator') }}</h3>
            <p class="text-gray-600 dark:text-gray-400">Calculate your monthly bill in advance</p>
        </div>
        <div class="card text-center fade-in-up" style="animation-delay: 0.2s;">
            <div class="text-sky-600 text-5xl mb-4">📞</div>
            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">{{ __('messages.contact') }}</h3>
            <p class="text-gray-600 dark:text-gray-400">24/7 support for all your needs</p>
        </div>
    </div>
</div>
@endsection
