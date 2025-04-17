@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Add Menu Item</h1>
            <p class="text-gray-600">{{ $category->name }} - {{ $category->menuType->name }}</p>
        </div>
        <div>
            <a href="{{ route('categories.menu-items.index', $category) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                Back to Menu Items
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('categories.menu-items.store', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" 
                       class="w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                       value="{{ old('name') }}" required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-3 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                <input type="number" name="price" id="price" step="0.01" min="0"
                       class="w-full px-3 py-2 border @error('price') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                       value="{{ old('price') }}" required>
                @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full px-3 py-2 border @error('image') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                <p class="text-gray-500 text-sm mt-1">Maximum file size: 1MB</p>
                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_available" value="1" 
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                           {{ old('is_available') ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700">Available</span>
                </label>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-200">
                    Save Menu Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection