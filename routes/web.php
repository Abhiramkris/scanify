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
  //  Route::resource('restaurants.menu-types', MenuTypeController::class)->shallow();
    
    // Add direct route for menu types
    Route::get('/menu-types', [MenuTypeController::class, 'index'])->name('menu-types.index');
    Route::get('/menu-types/create', [MenuTypeController::class, 'create'])->name('menu-types.create');
    Route::post('/menu-types', [MenuTypeController::class, 'store'])->name('menu-types.store');
    Route::get('/menu-types/{menu_type}/edit', [MenuTypeController::class, 'edit'])->name('menu-types.edit');
    Route::put('/menu-types/{menu_type}', [MenuTypeController::class, 'update'])->name('menu-types.update');
    Route::delete('/menu-types/{menu_type}', [MenuTypeController::class, 'destroy'])->name('menu-types.destroy');

    // Menu Category Management
    Route::resource('menu-types.categories', MenuCategoryController::class)->shallow();

    // Menu Item Management
    Route::resource('categories.menu-items', MenuItemController::class)->shallow();
});

// Public restaurant menu view route
Route::get('/{slug}', [RestaurantController::class, 'show'])->name('restaurant.menu');