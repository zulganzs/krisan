<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submit Meter Reading') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('bills.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Billing Month -->
                            <div>
                                <x-input-label for="billing_month" :value="__('Billing Month')" />
                                <x-text-input id="billing_month" class="block mt-1 w-full" type="date" name="billing_month" :value="old('billing_month', now()->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('billing_month')" class="mt-2" />
                            </div>

                            <!-- Previous Reading (Display Only) -->
                            <div>
                                <x-input-label for="previous_reading_display" :value="__('Previous Reading (m³)')" />
                                <x-text-input id="previous_reading_display" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" :value="$previousReading" disabled />
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Based on your last bill.</p>
                            </div>

                            <!-- Current Reading -->
                            <div>
                                <x-input-label for="current_reading" :value="__('Current Reading (m³)')" />
                                <x-text-input id="current_reading" class="block mt-1 w-full" type="number" step="0.01" name="current_reading" :value="old('current_reading')" required />
                                <x-input-error :messages="$errors->get('current_reading')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 mr-4">Cancel</a>
                            <x-primary-button>
                                {{ __('Submit Reading') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
