@extends('layouts.app')

@section('title', __('messages.contact'))

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">{{ __('pages.contact_title') }}</h1>
    <p class="text-gray-600 dark:text-gray-400 mb-8">{{ __('pages.contact_subtitle') }}</p>
    
    <div class="card">
        <form method="POST" action="#" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('pages.subject') }}
                </label>
                <input type="text" name="subject" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('pages.category') }}
                </label>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white" required>
                    <option value="leak_report">{{ __('pages.leak_report') }}</option>
                    <option value="billing_inquiry">{{ __('pages.billing_inquiry') }}</option>
                    <option value="connection_request">{{ __('pages.connection_request') }}</option>
                    <option value="other">{{ __('pages.other') }}</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('pages.message') }}
                </label>
                <textarea name="message" rows="6" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 dark:bg-gray-700 dark:text-white" required></textarea>
            </div>

            <button type="submit" class="btn-primary w-full">
                {{ __('messages.submit') }}
            </button>
        </form>
    </div>
</div>
@endsection
