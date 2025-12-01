@extends('layouts.app')

@section('title', __('messages.dashboard'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8">{{ __('messages.welcome') }}, {{ $user->name }}!</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card bg-sky-50 dark:bg-sky-900/30">
            <div class="flex items-center">
                <div class="text-sky-600 dark:text-sky-400 text-4xl mr-4">👤</div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.customer_id') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $user->customer_id ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        
        <div class="card bg-green-50 dark:bg-green-900/30">
            <div class="flex items-center">
                <div class="text-green-600 dark:text-green-400 text-4xl mr-4">📊</div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.total_bills') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalBills }}</p>
                </div>
            </div>
        </div>
        
        <div class="card bg-red-50 dark:bg-red-900/30">
            <div class="flex items-center">
                <div class="text-red-600 dark:text-red-400 text-4xl mr-4">⚠️</div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.unpaid_bills') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $unpaidBills }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bills -->
    <div class="card">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('messages.recent_bills') }}</h2>
            @if($totalBills > 0)
                <a href="{{ route('billing-history') }}" class="text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300">
                    {{ __('messages.view') }} All →
                </a>
            @else
                <button type="button" 
                        onclick="window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'No billing history yet', type: 'info' } }))"
                        class="text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 cursor-pointer">
                    {{ __('messages.view') }} All →
                </button>
            @endif
        </div>
        
        @if($bills->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>{{ __('messages.usage') }}</th>
                            <th>{{ __('messages.total_cost') }}</th>
                            <th>{{ __('messages.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $bill->billing_month->format('M Y') }}</td>
                                <td>{{ $bill->formatted_usage }}</td>
                                <td>{{ $bill->formatted_total }}</td>
                                <td>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $bill->status == 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                        {{ $bill->status == 'unpaid' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                        {{ $bill->status == 'overdue' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}">
                                        {{ __('messages.'.$bill->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center py-8 text-gray-600 dark:text-gray-400">No billing history yet.</p>
        @endif
    </div>
</div>
@endsection
