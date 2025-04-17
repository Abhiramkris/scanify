<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Your Restaurants</h3>
                <div class="mb-4">
                    <a href="{{ route('restaurants.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create New Restaurant
                    </a>
                </div>

                @if($restaurants->isEmpty())
                    <p class="text-gray-500">You haven't created any restaurants yet.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($restaurants as $restaurant)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $restaurant->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $restaurant->slug }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('restaurants.edit', $restaurant) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <a href="{{ route('restaurants.menu-types.index', $restaurant) }}"
                                            class="text-blue-600 hover:text-blue-900 mr-3">Manage Menu</a>
                                        <a href="{{ route('restaurant.menu', $restaurant->slug) }}"
                                            class="text-green-600 hover:text-green-900" target="_blank">View Menu</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <!-- Add this somewhere in your login form view -->
    @if (session('error'))
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ session('error') }}
        </div>
    @endif
</x-app-layout>