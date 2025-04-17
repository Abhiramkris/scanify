<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index(MenuCategory $category)
    {
        $this->authorize('view', $category->menuType->restaurant);
        $menuItems = $category->menuItems;
        return view('menu-items.index', compact('category', 'menuItems'));
    }

    public function create(MenuCategory $category)
    {
        $this->authorize('update', $category->menuType->restaurant);
        return view('menu-items.create', compact('category'));
    }

    public function store(Request $request, MenuCategory $category)
{
    $this->authorize('update', $category->menuType->restaurant);
    
    $validated = $request->validate([
        'name' => 'required|max:255',
        'description' => 'nullable',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|max:1024',
        'is_available' => 'boolean',
    ]);
    
    // Add the restaurant_id
    $validated['restaurant_id'] = $category->menuType->restaurant->id;
    
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('menu-items', 'public');
    }
    
    $category->menuItems()->create($validated);
    
    return redirect()->route('categories.menu-items.index', $category)
        ->with('success', 'Menu item created successfully.');
}

    public function edit(MenuCategory $category, MenuItem $menuItem)
    {
        $this->authorize('update', $category->menuType->restaurant);
        return view('menu-items.edit', compact('category', 'menuItem'));
    }

    public function update(Request $request, MenuCategory $category, MenuItem $menuItem)
    {
        $this->authorize('update', $category->menuType->restaurant);
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:1024',
            'is_available' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }
            $validated['image'] = $request->file('image')->store('menu-items', 'public');
        }

        $menuItem->update($validated);

        return redirect()->route('categories.menu-items.index', $category)
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuCategory $category, MenuItem $menuItem)
    {
        $this->authorize('update', $category->menuType->restaurant);
        
        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }
        
        $menuItem->delete();

        return redirect()->route('categories.menu-items.index', $category)
            ->with('success', 'Menu item deleted successfully.');
    }
}