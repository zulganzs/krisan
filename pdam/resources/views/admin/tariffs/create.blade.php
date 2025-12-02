<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Tariff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.tariffs.store') }}" method="POST" class="space-y-6 max-w-xl">
                        @csrf
                        
                        <div>
                            <x-input-label for="tier_name" :value="__('Tier Name')" />
                            <x-text-input id="tier_name" name="tier_name" type="text" class="mt-1 block w-full" :value="old('tier_name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('tier_name')" />
                        </div>

                        <div>
                            <x-input-label for="min_usage" :value="__('Minimum Usage (m³)')" />
                            <x-text-input id="min_usage" name="min_usage" type="number" class="mt-1 block w-full" :value="old('min_usage')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('min_usage')" />
                        </div>

                        <div>
                            <x-input-label for="max_usage" :value="__('Maximum Usage (m³) - Leave empty for infinity')" />
                            <x-text-input id="max_usage" name="max_usage" type="number" class="mt-1 block w-full" :value="old('max_usage')" />
                            <x-input-error class="mt-2" :messages="$errors->get('max_usage')" />
                        </div>

                        <div>
                            <x-input-label for="price_per_m3" :value="__('Price per m³ (Rp)')" />
                            <x-text-input id="price_per_m3" name="price_per_m3" type="number" class="mt-1 block w-full" :value="old('price_per_m3')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price_per_m3')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create Tariff') }}</x-primary-button>
                            <a href="{{ route('admin.tariffs.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
