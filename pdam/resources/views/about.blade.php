@extends('layouts.app')

@section('title', __('messages.about'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8">{{ __('pages.about_title') }}</h1>
    
    <div class="card mb-8">
        <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
            {{ __('pages.about_description') }}
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="card">
            <h2 class="text-2xl font-semibold text-sky-600 dark:text-sky-400 mb-4">{{ __('pages.our_vision') }}</h2>
            <p class="text-gray-700 dark:text-gray-300">{{ __('pages.vision_text') }}</p>
        </div>
        <div class="card">
            <h2 class="text-2xl font-semibold text-sky-600 dark:text-sky-400 mb-4">{{ __('pages.our_mission') }}</h2>
            <p class="text-gray-700 dark:text-gray-300">{{ __('pages.mission_text') }}</p>
        </div>
    </div>
</div>
@endsection
