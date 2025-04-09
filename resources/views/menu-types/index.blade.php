<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menu Types') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-lg font-semibold">{{ __('Menu Types') }}</span>
                        <a href="{{ route('menu-types.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            {{ __('Create New') }}
                        </a>
                    </div>

                    <a href="{{ route('restaurants.menu-types.create', ['restaurant' => $restaurant->id]) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create New Menu type
                    </a>


                    @if (session('status'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{ __('ID') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{ __('Name') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{ __('Description') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{ __('Status') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{ __('Display Order') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{ __('Items Count') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menuTypes as $menuType)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $menuType->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ $menuType->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ Str::limit($menuType->description, 30) ?: __('Not provided') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $menuType->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $menuType->is_active ? __('Active') : __('Inactive') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            {{ $menuType->display_order }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                       
                                            
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('menu-types.show', $menuType->id) }}"
                                                    class="inline-flex items-center px-3 py-1 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600">
                                                    {{ __('View') }}
                                                </a>
                                                <a href="{{ route('menu-types.edit', $menuType->id) }}"
                                                    class="inline-flex items-center px-3 py-1 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600">
                                                    {{ __('Edit') }}
                                                </a>
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-1 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600"
                                                    onclick="event.preventDefault();
                                                        if(confirm('{{ __('Are you sure you want to delete this menu type?') }}')) {
                                                            document.getElementById('delete-form-{{ $menuType->id }}').submit();
                                                        }">
                                                    {{ __('Delete') }}
                                                </button>
                                                <form id="delete-form-{{ $menuType->id }}"
                                                    action="{{ route('menu-types.destroy', $menuType->id) }}" method="POST"
                                                    class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center">
                                            {{ __('No menu types found.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>