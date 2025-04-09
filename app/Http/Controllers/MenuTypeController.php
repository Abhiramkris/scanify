<?php

namespace App\Http\Controllers;

use App\Models\MenuType;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuTypeController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $this->authorize('view', $restaurant);
        $menuTypes = $restaurant->menuTypes()->orderBy('display_order')->get();
        return view('menu-types.index', compact('restaurant', 'menuTypes'));
    }

    public function create(Restaurant $restaurant)
    {
        $this->authorize('update', $restaurant);
        return view('menu-types.create', compact('restaurant'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        $this->authorize('update', $restaurant);
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'display_order' => 'nullable|integer',
        ]);

        $restaurant->menuTypes()->create($validated);

        return redirect()->route('restaurants.menu-types.index', $restaurant)
            ->with('success', 'Menu type created successfully.');
    }

    public function edit(Restaurant $restaurant, MenuType $menuType)
    {
        $this->authorize('update', $restaurant);
        return view('menu-types.edit', compact('restaurant', 'menuType'));
    }

    public function update(Request $request, Restaurant $restaurant, MenuType $menuType)
    {
        $this->authorize('update', $restaurant);
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'display_order' => 'nullable|integer',
        ]);

        $menuType->update($validated);

        return redirect()->route('restaurants.menu-types.index', $restaurant)
            ->with('success', 'Menu type updated successfully.');
    }

    public function destroy(Restaurant $restaurant, MenuType $menuType)
    {
        $this->authorize('update', $restaurant);
        $menuType->delete();

        return redirect()->route('restaurants.menu-types.index', $restaurant)
            ->with('success', 'Menu type deleted successfully.');
    }
}