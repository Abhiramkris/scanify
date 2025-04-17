<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Menu Type for') }} {{ $restaurant->name }}
            </h2>
            <a href="{{ route('restaurants.menu-types.index', $restaurant) }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; Back to Menu Types
            </a>
        </div>
    </x-slot>
  
    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('restaurants.menu-types.store', $restaurant) }}">
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('Menu Type Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-jet-input-error for="name" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Examples: Breakfast Menu, Drinks Menu, Alcoholic Beverages, etc.</p>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description (Optional)') }}" />
                        <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" rows="3">{{ old('description') }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="display_order" value="{{ __('Display Order') }}" />
                        <x-jet-input id="display_order" class="block mt-1 w-full" type="number" name="display_order" :value="old('display_order', 0)" min="0" />
                        <x-jet-input-error for="display_order" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Lower numbers will be displayed first.</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create Menu Type') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>