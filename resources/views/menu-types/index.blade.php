@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Menu Types') }}</span>
                    <a href="{{ route('menu-types.create') }}" class="btn btn-sm btn-primary">{{ __('Create New') }}</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Display Order') }}</th>
                                    <th>{{ __('Items Count') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menuTypes as $menuType)
                                    <tr>
                                        <td>{{ $menuType->id }}</td>
                                        <td>{{ $menuType->name }}</td>
                                        <td>{{ Str::limit($menuType->description, 30) ?: __('Not provided') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $menuType->is_active ? 'success' : 'danger' }}">
                                                {{ $menuType->is_active ? __('Active') : __('Inactive') }}
                                            </span>
                                        </td>
                                        <td>{{ $menuType->display_order }}</td>
                                        <td>{{ $menuType->menuItems->count() }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('menu-types.show', $menuType->id) }}" class="btn btn-sm btn-info">{{ __('View') }}</a>
                                                <a href="{{ route('menu-types.edit', $menuType->id) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                                <button type="button" class="btn btn-sm btn-danger" 
                                                    onclick="event.preventDefault();
                                                    if(confirm('{{ __('Are you sure you want to delete this menu type?') }}')) {
                                                        document.getElementById('delete-form-{{ $menuType->id }}').submit();
                                                    }">
                                                    {{ __('Delete') }}
                                                </button>
                                                <form id="delete-form-{{ $menuType->id }}" action="{{ route('menu-types.destroy', $menuType->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">{{ __('No menu types found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $menuTypes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection