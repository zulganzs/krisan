<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($bill) ? __('Edit Bill') : __('Create Bill') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ isset($bill) ? route('admin.bills.update', $bill) : route('admin.bills.store') }}" method="POST">
                        @csrf
                        @if(isset($bill))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- User Selection -->
                            <div>
                                <x-input-label for="user_id" :value="__('Customer')" />
                                <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Select Customer</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ (old('user_id', $bill->user_id ?? '') == $user->id) ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->customer_id }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <!-- Billing Month -->
                            <div>
                                <x-input-label for="billing_month" :value="__('Billing Month')" />
                                <x-text-input id="billing_month" class="block mt-1 w-full" type="date" name="billing_month" :value="old('billing_month', isset($bill) ? $bill->billing_month->format('Y-m-d') : '')" required />
                                <x-input-error :messages="$errors->get('billing_month')" class="mt-2" />
                            </div>

                            <!-- Previous Reading -->
                            <div>
                                <x-input-label for="previous_reading" :value="__('Previous Reading (m³)')" />
                                <x-text-input id="previous_reading" class="block mt-1 w-full" type="number" step="0.01" name="previous_reading" :value="old('previous_reading', $bill->previous_reading ?? '')" required />
                                <x-input-error :messages="$errors->get('previous_reading')" class="mt-2" />
                            </div>

                            <!-- Current Reading -->
                            <div>
                                <x-input-label for="current_reading" :value="__('Current Reading (m³)')" />
                                <x-text-input id="current_reading" class="block mt-1 w-full" type="number" step="0.01" name="current_reading" :value="old('current_reading', $bill->current_reading ?? '')" required />
                                <x-input-error :messages="$errors->get('current_reading')" class="mt-2" />
                            </div>

                            <!-- Admin Fee -->
                            <div>
                                <x-input-label for="admin_fee" :value="__('Admin Fee (Rp)')" />
                                <x-text-input id="admin_fee" class="block mt-1 w-full" type="number" step="0.01" name="admin_fee" :value="old('admin_fee', $bill->admin_fee ?? 2500)" />
                                <x-input-error :messages="$errors->get('admin_fee')" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="unpaid" {{ (old('status', $bill->status ?? '') == 'unpaid') ? 'selected' : '' }}>Unpaid</option>
                                    <option value="paid" {{ (old('status', $bill->status ?? '') == 'paid') ? 'selected' : '' }}>Paid</option>
                                    <option value="overdue" {{ (old('status', $bill->status ?? '') == 'overdue') ? 'selected' : '' }}>Overdue</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.bills.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 mr-4">Cancel</a>
                            <x-primary-button>
                                {{ isset($bill) ? __('Update Bill') : __('Create Bill') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
