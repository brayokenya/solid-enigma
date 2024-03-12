<!-- resources/views/casuals/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Casual Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('casuals.update', $casualEmployee->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Input fields for editing casual employee details -->
                        <div class="mb-4">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="first_name" name="first_name"
                                value="{{ $casualEmployee->first_name }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ $casualEmployee->last_name }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="id_number" class="block text-sm font-medium text-gray-700">ID/Passport
                                Number</label>
                            <input type="text" id="id_number" name="id_number" value="{{ $casualEmployee->id_number }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="casual_code" class="block text-sm font-medium text-gray-700">Casual Code</label>
                            <input type="text" id="casual_code" name="casual_code"
                                value="{{ $casualEmployee->casual_code }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="branch" class="block text-sm font-medium text-gray-700">Branch</label>
                            <input type="text" id="branch" name="branch" value="{{ $casualEmployee->branch }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone
                                Number</label>
                            <input type="text" id="phone_number" name="phone_number"
                                value="{{ $casualEmployee->phone_number }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <input type="text" id="gender" name="gender" value="{{ $casualEmployee->gender }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                            <input type="text" id="department" name="department"
                                value="{{ $casualEmployee->department }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="rate_per_day" class="block text-sm font-medium text-gray-700">Casual Rate per
                                day</label>
                            <input type="text" id="rate_per_day" name="rate_per_day"
                                value="{{ $casualEmployee->rate_per_day }}"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                                required>
                                <option value="active" {{ $casualEmployee->status == 'active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="inactive" {{ $casualEmployee->status == 'inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>