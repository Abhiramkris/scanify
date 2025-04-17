

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Restaurant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('restaurants.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Restaurant Name') }}</label>
                        <input id="name" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                        @error('name')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="slug" class="block font-medium text-sm text-gray-700">{{ __('Slug (URL identifier)') }}</label>
                        <input id="slug" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text" name="slug" value="{{ old('slug') }}" placeholder="leave-empty-for-auto-generation" />
                        @error('slug')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">The slug will be used in your restaurant's URL: yourdomain.com/slug</p>
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                        <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="address" class="block font-medium text-sm text-gray-700">{{ __('Address') }}</label>
                        <input id="address" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text" name="address" value="{{ old('address') }}" />
                        @error('address')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="phone" class="block font-medium text-sm text-gray-700">{{ __('Phone') }}</label>
                        <input id="phone" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text" name="phone" value="{{ old('phone') }}" />
                        @error('phone')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="logo" class="block font-medium text-sm text-gray-700">{{ __('Logo') }}</label>
                        <input id="logo" name="logo" type="file" class="mt-1" accept="image/*">
                        @error('logo')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <h3 class="font-medium text-gray-700 mb-2">Menu Appearance</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="background_color" class="block font-medium text-sm text-gray-700">{{ __('Background Color') }}</label>
                                <div class="flex mt-1">
                                    <input id="background_color" name="background_color" type="color" class="h-10 w-10" value="{{ old('background_color', '#ffffff') }}">
                                    <input type="text" class="ml-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('background_color', '#ffffff') }}" 
                                        onchange="document.getElementById('background_color').value = this.value" />
                                </div>
                                @error('background_color')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="text_color" class="block font-medium text-sm text-gray-700">{{ __('Text Color') }}</label>
                                <div class="flex mt-1">
                                    <input id="text_color" name="text_color" type="color" class="h-10 w-10" value="{{ old('text_color', '#000000') }}">
                                    <input type="text" class="ml-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('text_color', '#000000') }}" 
                                        onchange="document.getElementById('text_color').value = this.value" />
                                </div>
                                @error('text_color')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="button_color" class="block font-medium text-sm text-gray-700">{{ __('Button Color') }}</label>
                                <div class="flex mt-1">
                                    <input id="button_color" name="button_color" type="color" class="h-10 w-10" value="{{ old('button_color', '#3490dc') }}">
                                    <input type="text" class="ml-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('button_color', '#3490dc') }}" 
                                        onchange="document.getElementById('button_color').value = this.value" />
                                </div>
                                @error('button_color')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Create Restaurant') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
