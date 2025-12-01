@extends('layouts.app')

@section('title', __('messages.billing_history'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8">{{ __('messages.billing_history') }}</h1>
    
    <div class="card">
        @if($bills->count() > 0)
            <!-- LOOPING REQUIREMENT: @foreach loop to render billing history table -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('messages.billing_history') }}</th>
                            <th>{{ __('messages.usage') }}</th>
                            <th>{{ __('messages.rate_applied') }}</th>
                            <th>{{ __('messages.total_cost') }}</th>
                            <th>{{ __('messages.status') }}</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <td>{{ $bill->billing_month->format('F Y') }}</td>
                                <td>{{ $bill->formatted_usage }}</td>
                                <td>Rp {{ number_format($bill->rate_applied, 0, ',', '.') }}/m³</td>
                                <td class="font-semibold">{{ $bill->formatted_total }}</td>
                                <td>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $bill->status == 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                        {{ $bill->status == 'unpaid' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                        {{ $bill->status == 'overdue' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}">
                                        {{ __('messages.'.$bill->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="text-sky-600 dark:text-sky-400 hover:text-sky-700 dark:hover:text-sky-300 text-sm font-medium">
                                        {{ __('messages.download') }} PDF
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $bills->links() }}
            </div>
        @else
            <p class="text-center py-12 text-gray-600 dark:text-gray-400">No billing history yet.</p>
        @endif
    </div>
</div>
@endsection
