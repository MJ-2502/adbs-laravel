<x-layout>
    <x-slot name="title">Certificate Request Details</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('certificates.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                ← Back to My Requests
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Certificate Request Details</h1>
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

                <!-- Request Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Certificate Type</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $certificate->certificateType->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fee</label>
                        <p class="text-lg font-semibold text-gray-900">₱{{ number_format($certificate->certificateType->fee, 2) }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Purpose</label>
                        <p class="text-gray-900">{{ $certificate->purpose }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Request Date</label>
                        <p class="text-gray-900">{{ $certificate->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                </div>

                @if($certificate->notes)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                        <p class="text-gray-900">{{ $certificate->notes }}</p>
                    </div>
                @endif

                <!-- Certificate Description and Requirements -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Certificate Information</h3>
                    <p class="text-gray-600 mb-4">{{ $certificate->certificateType->description }}</p>

                    @if($certificate->certificateType->requirements)
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Requirements:</h4>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($certificate->certificateType->requirements as $requirement)
                                    <li class="text-gray-600">{{ $requirement }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Processing Information -->
                @if($certificate->approved_at || $certificate->released_at || $certificate->rejection_reason)
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Processing Information</h3>
                        
                        @if($certificate->approved_at)
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Approved On</label>
                                <p class="text-gray-900">{{ $certificate->approved_at->format('F d, Y h:i A') }}</p>
                            </div>
                        @endif

                        @if($certificate->released_at)
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Released On</label>
                                <p class="text-gray-900">{{ $certificate->released_at->format('F d, Y h:i A') }}</p>
                            </div>
                        @endif

                        @if($certificate->rejection_reason)
                            <div class="bg-red-50 border border-red-200 rounded-md p-4">
                                <label class="block text-sm font-medium text-red-800 mb-1">Rejection Reason</label>
                                <p class="text-red-700">{{ $certificate->rejection_reason }}</p>
                            </div>
                        @endif

                        @if($certificate->processor)
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Processed By</label>
                                <p class="text-gray-900">{{ $certificate->processor->name }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Status-specific messages -->
                @if($certificate->status === 'ready_for_pickup')
                    <div class="bg-purple-50 border border-purple-200 rounded-md p-4">
                        <h4 class="text-purple-800 font-semibold mb-2">Your certificate is ready for pickup!</h4>
                        <p class="text-purple-700 text-sm">Please visit the barangay hall during office hours to claim your certificate.</p>
                    </div>
                @endif

                @if($certificate->status === 'released')
                    <div class="bg-green-50 border border-green-200 rounded-md p-4">
                        <h4 class="text-green-800 font-semibold mb-2">Certificate Released</h4>
                        <p class="text-green-700 text-sm">Your certificate has been successfully released. Thank you!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
