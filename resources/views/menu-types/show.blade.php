@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Menu Type Details') }}</span>
                    <div>
                        <a href="{{ route('menu-types.edit', $menuType->id) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                        <a href="{{ route('menu-types.index') }}" class="btn btn-sm btn-secondary">{{ __('Back to List') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 30%">{{ __('ID') }}</th>
                                <td>{{ $menuType->id }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <td>{{ $menuType->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Description') }}</th>
                                <td>{{ $menuType->description ?: __('Not provided') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Status') }}</th>
                                <td>
                                    <span class="badge bg-{{ $menuType->is_active ? 'success' : 'danger' }}">
                                        {{ $menuType->is_active ? __('Active') : __('Inactive') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('Display Order') }}</th>
                                <td>{{ $menuType->display_order }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Created At') }}</th>
                                <td>{{ $menuType->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Updated At') }}</th>
                                <td>{{ $menuType->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <h5>{{ __('Menu Items in this Type') }}</h5>
                        @if($menuType->menuItems->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menuType->menuItems as $menuItem)
                                        <tr>
                                            <td>{{ $menuItem->name }}</td>
                                            <td>${{ number_format($menuItem->price, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $menuItem->is_active ? 'success' : 'danger' }}">
                                                    {{ $menuItem->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('menu-items.show', $menuItem->id) }}" class="btn btn-sm btn-info">{{ __('View') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">{{ __('No menu items found in this category.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection