// resources/views/restaurants/create.blade.php
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
                        <x-jet-label for="name" value="{{ __('Restaurant Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="slug" value="{{ __('Slug (URL identifier)') }}" />
                        <x-jet-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" placeholder="leave-empty-for-auto-generation" />
                        <x-jet-input-error for="slug" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">The slug will be used in your restaurant's URL: yourdomain.com/slug</p>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" rows="3">{{ old('description') }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
                        <x-jet-input-error for="address" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="phone" value="{{ __('Phone') }}" />
                        <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                        <x-jet-input-error for="phone" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="logo" value="{{ __('Logo') }}" />
                        <input id="logo" name="logo" type="file" class="mt-1" accept="image/*">
                        <x-jet-input-error for="logo" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <h3 class="font-medium text-gray-700 mb-2">Menu Appearance</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-jet-label for="background_color" value="{{ __('Background Color') }}" />
                                <div class="flex mt-1">
                                    <input id="background_color" name="background_color" type="color" class="h-10 w-10" value="{{ old('background_color', '#ffffff') }}">
                                    <x-jet-input type="text" class="ml-2 block w-full" value="{{ old('background_color', '#ffffff') }}" 
                                                onchange="document.getElementById('background_color').value = this.value" />
                                </div>
                                <x-jet-input-error for="background_color" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-jet-label for="text_color" value="{{ __('Text Color') }}" />
                                <div class="flex mt-1">
                                    <input id="text_color" name="text_color" type="color" class="h-10 w-10" value="{{ old('text_color', '#000000') }}">
                                    <x-jet-input type="text" class="ml-2 block w-full" value="{{ old('text_color', '#000000') }}" 
                                                onchange="document.getElementById('text_color').value = this.value" />
                                </div>
                                <x-jet-input-error for="text_color" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-jet-label for="button_color" value="{{ __('Button Color') }}" />
                                <div class="flex mt-1">
                                    <input id="button_color" name="button_color" type="color" class="h-10 w-10" value="{{ old('button_color', '#3490dc') }}">
                                    <x-jet-input type="text" class="ml-2 block w-full" value="{{ old('button_color', '#3490dc') }}" 
                                                onchange="document.getElementById('button_color').value = this.value" />
                                </div>
                                <x-jet-input-error for="button_color" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create Restaurant') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>