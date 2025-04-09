<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $restaurant->name }}
        </h2>
    </x-slot>

    <div style="background-color: {{ $restaurant->background_color }}; color: {{ $restaurant->text_color }};" class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col items-center">
                @if($restaurant->logo)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}" class="h-24 w-auto">
                    </div>
                @endif
                
                @if($restaurant->description)
                    <div class="text-center max-w-2xl mb-4">
                        <p>{{ $restaurant->description }}</p>
                    </div>
                @endif
                
                <div class="text-center space-y-1">
                    @if($restaurant->address)
                        <p class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            {{ $restaurant->address }}
                        </p>
                    @endif
                    
                    @if($restaurant->phone)
                        <p class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            {{ $restaurant->phone }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($menuTypes->isEmpty())
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                    <p>No menu items available at this time.</p>
                </div>
            @else
                <div class="mb-6 overflow-x-auto">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        @foreach($menuTypes as $index => $type)
                            <button type="button"
                                class="menu-tab-button px-4 py-2 text-sm font-medium {{ $index === 0 ? 'bg-opacity-100 text-white' : 'bg-opacity-0 hover:bg-opacity-20' }}"
                                style="background-color: {{ $index === 0 ? $restaurant->button_color : 'transparent' }}; 
                                       color: {{ $index === 0 ? '#ffffff' : $restaurant->text_color }};"
                                data-tab="menu-type-{{ $type->id }}">
                                {{ $type->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div>
                    @foreach($menuTypes as $index => $type)
                        <div id="menu-type-{{ $type->id }}" 
                             class="menu-tab-content {{ $index === 0 ? 'block' : 'hidden' }}">
                            
                            <h2 class="text-2xl font-bold mb-6" style="color: {{ $restaurant->button_color }}">
                                {{ $type->name }}
                            </h2>
                            
                            @if($type->categories->isEmpty())
                                <p>No categories available for this menu type.</p>
                            @else
                                @foreach($type->categories as $category)
                                    <div class="mb-10">
                                        <h3 class="text-xl font-semibold mb-3 pb-2" 
                                            style="border-bottom: 2px solid {{ $restaurant->button_color }}">
                                            {{ $category->name }}
                                        </h3>
                                        
                                        @if($category->description)
                                            <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                                        @endif
                                        
                                        @if($category->menuItems->isEmpty())
                                            <p>No items available in this category.</p>
                                        @else
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                @foreach($category->menuItems as $item)
                                                    <div class="bg-white rounded-lg shadow-md p-4 h-full flex flex-col">
                                                        <div class="flex justify-between mb-2">
                                                            <h4 class="font-medium text-lg">{{ $item->name }}</h4>
                                                            <div class="font-bold" style="color: {{ $restaurant->button_color }}">
                                                                ${{ number_format($item->price, 2) }}
                                                            </div>
                                                        </div>
                                                        
                                                        @if($item->description)
                                                            <p class="text-gray-600 text-sm mb-3">{{ $item->description }}</p>
                                                        @endif
                                                        
                                                        @if($item->image)
                                                            <div class="mt-auto pt-3">
                                                                <img src="{{ asset('storage/' . $item->image) }}" 
                                                                     alt="{{ $item->name }}" 
                                                                     class="rounded-md w-full">
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @push('modals')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.menu-tab-button');
            const tabContents = document.querySelectorAll('.menu-tab-content');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                        content.classList.remove('block');
                    });
                    
                    // Deactivate all tab buttons
                    tabButtons.forEach(btn => {
                        btn.classList.remove('bg-opacity-100', 'text-white');
                        btn.classList.add('bg-opacity-0');
                        btn.style.backgroundColor = 'transparent';
                        btn.style.color = '{{ $restaurant->text_color }}';
                    });
                    
                    // Activate selected tab button
                    this.classList.add('bg-opacity-100', 'text-white');
                    this.classList.remove('bg-opacity-0');
                    this.style.backgroundColor = '{{ $restaurant->button_color }}';
                    this.style.color = '#ffffff';
                    
                    // Show selected tab content
                    document.getElementById(tabId).classList.remove('hidden');
                    document.getElementById(tabId).classList.add('block');
                });
            });
        });
    </script>
    @endpush
</x-app-layout>