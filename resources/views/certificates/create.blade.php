<x-layout>
    <x-slot name="title">Request New Certificate</x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Request New Certificate</h1>
            <p class="mt-2 text-gray-600">Fill out the form below to submit your certificate request.</p>
        </div>

        <form action="{{ route('certificates.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf

            <div class="space-y-6">
                <!-- Certificate Type -->
                <div>
                    <label for="certificate_type_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Certificate Type <span class="text-red-500">*</span>
                    </label>
                    <select name="certificate_type_id" id="certificate_type_id" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select a certificate type</option>
                        @foreach($certificateTypes as $type)
                            <option value="{{ $type->id }}" {{ old('certificate_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }} (₱{{ number_format($type->fee, 2) }})
                            </option>
                        @endforeach
                    </select>
                    @error('certificate_type_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Certificate Details Display -->
                <div id="certificate-details" class="hidden bg-blue-50 p-4 rounded-md">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Certificate Details</h3>
                    <p id="certificate-description" class="text-sm text-gray-600 mb-2"></p>
                    <div id="certificate-requirements" class="text-sm text-gray-600"></div>
                </div>

                <!-- Purpose -->
                <div>
                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">
                        Purpose <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="purpose" id="purpose" required
                        value="{{ old('purpose') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g., Employment, School Requirements, etc.">
                    @error('purpose')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Additional Notes (Optional)
                    </label>
                    <textarea name="notes" id="notes" rows="4"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Any additional information...">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('certificates.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit Request
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const certificateTypes = @json($certificateTypes);
            const selectElement = document.getElementById('certificate_type_id');
            const detailsDiv = document.getElementById('certificate-details');
            const descriptionElement = document.getElementById('certificate-description');
            const requirementsElement = document.getElementById('certificate-requirements');

            selectElement.addEventListener('change', function() {
                const selectedId = parseInt(this.value);
                const selectedType = certificateTypes.find(type => type.id === selectedId);

                if (selectedType) {
                    descriptionElement.textContent = selectedType.description;
                    
                    if (selectedType.requirements && selectedType.requirements.length > 0) {
                        requirementsElement.innerHTML = '<strong>Requirements:</strong><ul class="list-disc list-inside mt-1">' +
                            selectedType.requirements.map(req => `<li>${req}</li>`).join('') +
                            '</ul>';
                    } else {
                        requirementsElement.innerHTML = '';
                    }
                    
                    detailsDiv.classList.remove('hidden');
                } else {
                    detailsDiv.classList.add('hidden');
                }
            });
        });
    </script>
</x-layout>
