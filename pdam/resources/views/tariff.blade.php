@extends('layouts.app')

@section('title', __('messages.tariff'))

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8">{{ __('messages.tariff') }}</h1>
    
    <div class="card">
        <p class="text-gray-700 dark:text-gray-300 mb-6">
            {{ __('messages.tariff_intro') }}
        </p>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('messages.tier_name') }}</th>
                        <th>{{ __('messages.usage_range') }}</th>
                        <th>{{ __('messages.price_per_m3') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tariffs as $tariff)
                        <tr>
                            <td class="font-semibold text-blue-600 dark:text-blue-400">{{ $tariff->tier_name }}</td>
                            <td>
                                {{ number_format($tariff->min_usage, 0) }} - 
                                {{ $tariff->max_usage ? number_format($tariff->max_usage, 0) : '∞' }} m³
                            </td>
                            <td class="font-semibold">Rp {{ number_format($tariff->price_per_m3, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                <strong>Note:</strong> {{ __('messages.tariff_note') }}
            </p>
        </div>
    </div>
</div>
@endsection
