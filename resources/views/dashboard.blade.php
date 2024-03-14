<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <!-- Download Form Button -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('casuals.downloadForm', $casualEmployee) }}" class="btn btn-primary">Download Form</a>
                </td>

        <!-- In your view file -->
        @if(Session::has('download.in.the.next.request'))
            <script>
                // Create a hidden link and trigger the download
                var link = document.createElement('a');
                link.href = 'casual.pdf' + '{{ Session::get('download.in.the.next.request') }}';
                link.download = '{{ Session::get('download.in.the.next.request') }}';
                document.body.appendChild(link);
                link.click();
            </script>
        @endif

    {{-- </div>
    <td class="px-6 py-4 whitespace-nowrap">
        <a href="{{ route('download.form', $casualEmployee->id) }}" class="btn btn-primary">Download Form</a>
    </td> --}}
    @if(Session::has('download.in.the.next.request'))
         <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
      @endif

                <!-- Onboard a Casual Employee Form -->
                <div class="p-6">
                    <form method="POST" action="{{ route('casuals.onboard') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="first_name" name="first_name"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="last_name" name="last_name"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="id_number" class="block text-sm font-medium text-gray-700">ID/Passport
                                Number</label>
                            <input type="text" id="id_number" name="id_number"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <!-- Add other input fields for Casual Code, Branch, Phone Number, Gender, Department, Casual Rate per day -->
                        <div class="mb-4">
                            <label for="casual_code" class="block text-sm font-medium text-gray-700">Casual Code</label>
                            <input type="text" id="casual_code" name="casual_code"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="branch" class="block text-sm font-medium text-gray-700">Branch</label>
                            <input type="text" id="branch" name="branch"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone
                                Number</label>
                            <input type="text" id="phone_number" name="phone_number"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <input type="text" id="gender" name="gender"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                            <input type="text" id="department" name="department"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="rate_per_day" class="block text-sm font-medium text-gray-700">Casual Rate per
                                day</label>
                            <input type="text" id="rate_per_day" name="rate_per_day"
                                class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
                <!-- List of Casual Employees -->
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">List of Casual Employees</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        First Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Last Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID/Passport Number
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Casual Code
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Branch
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Phone Number
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Gender
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Department
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rate per Day
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>

                                    <!-- Add similar th elements for other fields -->
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($casualEmployees as $casualEmployee)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->first_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->last_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->id_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->casual_code }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->branch }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->phone_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->gender }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->department }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->rate_per_day }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $casualEmployee->status }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('casuals.edit', $casualEmployee) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('download.form', $casualEmployee) }}" class="btn btn-primary">Download Form</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
