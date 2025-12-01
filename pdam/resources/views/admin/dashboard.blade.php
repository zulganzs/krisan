@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8">Admin Dashboard</h1>
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="card bg-blue-50 dark:bg-blue-900/30">
            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Total Users</p>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total_users'] }}</p>
            </div>
        </div>
        
        <div class="card bg-green-50 dark:bg-green-900/30">
            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Tariff Tiers</p>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $stats['total_tariffs'] }}</p>
            </div>
        </div>
        
        <div class="card bg-purple-50 dark:bg-purple-900/30">
            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Total Bills</p>
                <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['total_bills'] }}</p>
            </div>
        </div>
        
        <div class="card bg-red-50 dark:bg-red-900/30">
            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Open Tickets</p>
                <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $stats['open_tickets'] }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Tickets -->
    <div class="card">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Recent Support Tickets</h2>
        
        @if($stats['recent_tickets']->count() > 0)
            <div class="space-y-4">
                @foreach($stats['recent_tickets'] as $ticket)
                    <div class="border-l-4 border-sky-500 pl-4 py-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-white">{{ $ticket->subject }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($ticket->message, 100) }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-sky-100 text-sky-800 dark:bg-sky-900 dark:text-sky-300">
                                {{ $ticket->status }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center py-8 text-gray-600 dark:text-gray-400">No recent tickets.</p>
        @endif
    </div>
</div>
@endsection
