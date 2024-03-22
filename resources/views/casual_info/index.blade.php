<!-- resources/views/casual_info/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Casual Employees Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Filter form -->
                    <form action="{{ route('casual-info.index') }}" method="GET">
                        <div class="flex items-center">
                            <label for="name" class="mr-2">Name:</label>
                            <input type="text" name="name" id="name" value="{{ request('name') }}" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">

                            <label for="department" class="ml-4 mr-2">Department:</label>
                            <select name="department" id="department" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">Select Department</option>

                            </select>

                            <label for="status" class="ml-4 mr-2">Status:</label>
                            <select name="status" id="status" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">Select Status</option>

                            </select>

                            <button type="submit" class="ml-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Apply Filters
                            </button>
                        </div>
                    </form>

                    <!-- Display casual employees -->
                    <div class="mt-6">
                        <!-- Loop through $casualEmployees and display each employee's information -->
                    </div>

                    <!-- Pagination links -->
                    <div class="mt-6">
                        <!-- Display pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- resources/views/casual_info/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Casual Employees Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Filter form -->
                    <form action="{{ route('casual-info.index') }}" method="GET">
                        <div class="flex items-center">
                            <label for="name" class="mr-2">Name:</label>
                            <input type="text" name="name" id="name" value="{{ request('name') }}" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">

                            <label for="department" class="ml-4 mr-2">Department:</label>
                            <select name="department" id="department" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">Select Department</option>
                                <!-- Add options for departments -->
                            </select>

                            <label for="status" class="ml-4 mr-2">Status:</label>
                            <select name="status" id="status" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">Select Status</option>
                                <!-- Add options for status -->
                            </select>

                            <button type="submit" class="ml-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Apply Filters
                            </button>
                        </div>
                    </form>

                    <!-- Display casual employees -->
                    <div class="mt-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <!-- Table headers -->
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                                    <!-- Add more table headers for other fields -->
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($casualEmployees as $casualEmployee)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $casualEmployee->first_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $casualEmployee->last_name }}</td>
                                    <!-- Add more table cells for other fields -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination links -->
                    <div class="mt-6">
                        {{ $casualEmployees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
