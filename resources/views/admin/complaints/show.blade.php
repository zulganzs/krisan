<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket Details') }} #{{ $complaint->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Ticket Info -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">{{ $complaint->subject }}</h3>
                            <div class="prose dark:prose-invert max-w-none">
                                <p class="whitespace-pre-wrap">{{ $complaint->message }}</p>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between text-sm text-gray-500 dark:text-gray-400">
                                <span>Category: {{ ucfirst(str_replace('_', ' ', $complaint->category)) }}</span>
                                <span>Submitted: {{ $complaint->created_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar / Actions -->
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">User Information</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Name:</span> {{ $complaint->user->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $complaint->user->email }}</p>
                                <p><span class="font-medium">Customer ID:</span> {{ $complaint->user->customer_id ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Update Status</h3>
                            <form action="{{ route('admin.complaints.update', $complaint) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="open" {{ $complaint->status === 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                        <option value="closed" {{ $complaint->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </div>

                                <x-primary-button class="w-full justify-center">
                                    {{ __('Update Status') }}
                                </x-primary-button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('admin.complaints.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            ← Back to Complaints
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
