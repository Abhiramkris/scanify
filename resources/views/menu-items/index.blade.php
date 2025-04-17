@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Menu Items for {{ $category->name }}</h1>
            <p class="text-gray-600">{{ $category->menuType->name }} - {{ $category->menuType->restaurant->name }}</p>
        </div>
        <div>
            <a href="{{ route('menu-types.categories.index', $category->menuType) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">
                Back to Categories
            </a>
            <a href="{{ route('categories.menu-items.create', $category) }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                Add Menu Item
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if($menuItems->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($menuItems as $item)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($item->image)
            <div class="h-48 bg-gray-200">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
            </div>
            @else
            <div class="h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">No Image</span>
            </div>
            @endif
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <h2 class="text-xl font-bold">{{ $item->name }}</h2>
                    <span class="text-green-600 font-semibold">{{ number_format($item->price, 2) }}</span>
                </div>
                
                <p class="text-gray-600 mt-2">{{ $item->description ?? 'No description available' }}</p>
                
                <div class="mt-4 flex justify-between items-center">
                    <span class="px-2 py-1 rounded-full text-xs {{ $item->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $item->is_available ? 'Available' : 'Not Available' }}
                    </span>
                    
                    <div class="flex space-x-2">
                        <a href="{{ route('categories.menu-items.edit', [$category, $item]) }}" 
                           class="text-blue-500 hover:text-blue-700">
                            Edit
                        </a>
                        
                        <form action="{{ route('categories.menu-items.destroy', [$category, $item]) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-gray-100 rounded-lg p-6 text-center">
        <p class="text-gray-600">No menu items found. Add your first menu item to get started.</p>
        <a href="{{ route('categories.menu-items.create', $category) }}" 
           class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
            Add Menu Item
        </a>
    </div>
    @endif
</div>
@endsection