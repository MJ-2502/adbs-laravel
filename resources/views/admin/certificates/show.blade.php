<x-layout>
    <x-slot name="title">Admin - Manage Certificate Request</x-slot>

    <div class="max-w-5xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.certificates.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                ← Back to All Requests
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Certificate Details -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <!-- Header -->
                    <div class="bg-blue-600 px-6 py-4">
                        <h1 class="text-2xl font-bold text-white">Certificate Request #{{ $certificate->id }}</h1>
                    </div>

                    <!-- Content -->
                    <div class="p-6 space-y-6">
                        <!-- Status Badge -->
                        <div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'approved' => 'bg-green-100 text-green-800 border-green-200',
                                    'ready_for_pickup' => 'bg-purple-100 text-purple-800 border-purple-200',
                                    'released' => 'bg-gray-100 text-gray-800 border-gray-200',
                                    'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                ];
                            @endphp
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full border-2 {{ $statusColors[$certificate->status] ?? 'bg-gray-100 text-gray-800' }}">
                                Status: {{ ucwords(str_replace('_', ' ', $certificate->status)) }}
                            </span>
                        </div>

                        <!-- Resident Information -->
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Resident Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <p class="text-gray-900">{{ $certificate->user->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-gray-900">{{ $certificate->user->email }}</p>
                                </div>
                                @if($certificate->user->contact_number)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                                        <p class="text-gray-900">{{ $certificate->user->contact_number }}</p>
                                    </div>
                                @endif
                                @if($certificate->user->address)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <p class="text-gray-900">{{ $certificate->user->address }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Request Information -->
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Request Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Certificate Type</label>
                                    <p class="text-gray-900 font-semibold">{{ $certificate->certificateType->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Fee</label>
                                    <p class="text-gray-900 font-semibold">₱{{ number_format($certificate->certificateType->fee, 2) }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Purpose</label>
                                    <p class="text-gray-900">{{ $certificate->purpose }}</p>
                                </div>
                            </div>
                        </div>

                        @if($certificate->notes)
                            <div class="border-t pt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                                <p class="text-gray-900">{{ $certificate->notes }}</p>
                            </div>
                        @endif

                        <!-- Certificate Requirements -->
                        @if($certificate->certificateType->requirements)
                            <div class="border-t pt-6">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Requirements Checklist:</h4>
                                <ul class="space-y-2">
                                    @foreach($certificate->certificateType->requirements as $requirement)
                                        <li class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 rounded">
                                            <label class="ml-2 text-gray-600">{{ $requirement }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Processing Information -->
                        @if($certificate->processor || $certificate->approved_at || $certificate->released_at)
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Processing History</h3>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Requested On</label>
                                        <p class="text-gray-900">{{ $certificate->created_at->format('F d, Y h:i A') }}</p>
                                    </div>
                                    @if($certificate->processor)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Processed By</label>
                                            <p class="text-gray-900">{{ $certificate->processor->name }}</p>
                                        </div>
                                    @endif
                                    @if($certificate->approved_at)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Approved On</label>
                                            <p class="text-gray-900">{{ $certificate->approved_at->format('F d, Y h:i A') }}</p>
                                        </div>
                                    @endif
                                    @if($certificate->released_at)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Released On</label>
                                            <p class="text-gray-900">{{ $certificate->released_at->format('F d, Y h:i A') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($certificate->rejection_reason)
                            <div class="border-t pt-6">
                                <div class="bg-red-50 border border-red-200 rounded-md p-4">
                                    <label class="block text-sm font-medium text-red-800 mb-1">Rejection Reason</label>
                                    <p class="text-red-700">{{ $certificate->rejection_reason }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Panel -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                    
                    <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Update Status
                            </label>
                            <select name="status" id="status" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="pending" {{ $certificate->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $certificate->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="approved" {{ $certificate->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="ready_for_pickup" {{ $certificate->status === 'ready_for_pickup' ? 'selected' : '' }}>Ready for Pickup</option>
                                <option value="released" {{ $certificate->status === 'released' ? 'selected' : '' }}>Released</option>
                                <option value="rejected" {{ $certificate->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div id="rejection-reason-field" class="hidden">
                            <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                                Rejection Reason
                            </label>
                            <textarea name="rejection_reason" id="rejection_reason" rows="3"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Provide reason for rejection...">{{ old('rejection_reason', $certificate->rejection_reason) }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Status
                        </button>
                    </form>

                    <!-- Quick Action Buttons -->
                    @if($certificate->status === 'pending')
                        <div class="mt-4 pt-4 border-t space-y-2">
                            <p class="text-sm text-gray-600 mb-2">Quick Actions:</p>
                            <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="processing">
                                <button type="submit" class="w-full px-4 py-2 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100">
                                    Mark as Processing
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('status').addEventListener('change', function() {
            const rejectionField = document.getElementById('rejection-reason-field');
            if (this.value === 'rejected') {
                rejectionField.classList.remove('hidden');
                document.getElementById('rejection_reason').required = true;
            } else {
                rejectionField.classList.add('hidden');
                document.getElementById('rejection_reason').required = false;
            }
        });

        // Trigger on page load
        document.getElementById('status').dispatchEvent(new Event('change'));
    </script>
</x-layout>
