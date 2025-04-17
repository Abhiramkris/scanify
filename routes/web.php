<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuTypeController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Super Admin Routes
    Route::middleware(['can:viewAny,App\Models\User'])->group(function () {
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/admins', [AdminController::class, 'store'])->name('admin.store');
        Route::patch('/admins/{admin}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.toggle-status');
    });

    // Restaurant Management
    Route::resource('restaurants', RestaurantController::class)->except(['show']);

    // Menu Type Management
    Route::resource('restaurants.menu-types', MenuTypeController::class)->shallow();

    // Add direct route for menu types
    Route::get('/menu-types', [MenuTypeController::class, 'index'])->name('menu-types.index');
    Route::get('/restaurants/{restaurant}/menu-types/create', [MenuTypeController::class, 'create'])->name('restaurants.menu-types.create');
    Route::post('/menu-types', [MenuTypeController::class, 'store'])->name('menu-types.store');
    Route::get('/restaurants/{restaurant}/menu-types/{menu_type}/edit', [MenuTypeController::class, 'edit'])
        ->name('restaurants.menu-types.edit');
    Route::put('/menu-types/{menu_type}', [MenuTypeController::class, 'update'])->name('menu-types.update');
    Route::delete('/menu-types/{menu_type}', [MenuTypeController::class, 'destroy'])->name('menu-types.destroy');
    // In your routes/web.php
    Route::patch('/restaurants/{restaurant}/toggle-status', [RestaurantController::class, 'toggleStatus'])
        ->name('restaurants.toggle-status');
    // Menu Category Management
    Route::resource('menu-types.categories', MenuCategoryController::class)->shallow();

    // Menu Item Management
    Route::resource('categories.menu-items', MenuItemController::class)->shallow();

    // Menu Categories Routes
    Route::resource('menu-types.categories', MenuCategoryController::class)
        ->except(['show'])
        ->parameters([
            'categories' => 'category'
        ]);


    Route::middleware(['auth'])->group(function () {
        // Nested routes for menu items under categories
        Route::get('/categories/{category}/menu-items', [MenuItemController::class, 'index'])
            ->name('categories.menu-items.index');
        Route::get('/categories/{category}/menu-items/create', [MenuItemController::class, 'create'])
            ->name('categories.menu-items.create');
        Route::post('/categories/{category}/menu-items', [MenuItemController::class, 'store'])
            ->name('categories.menu-items.store');
        Route::get('/categories/{category}/menu-items/{menuItem}/edit', [MenuItemController::class, 'edit'])
            ->name('categories.menu-items.edit');
        Route::put('/categories/{category}/menu-items/{menuItem}', [MenuItemController::class, 'update'])
            ->name('categories.menu-items.update');
        Route::delete('/categories/{category}/menu-items/{menuItem}', [MenuItemController::class, 'destroy'])
            ->name('categories.menu-items.destroy');
    });
});
Route::middleware(['auth:sanctum', 'verified', 'active.user'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});
// Public restaurant menu view route
Route::get('/{slug}', [RestaurantController::class, 'show'])->name('restaurant.menu');