<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuType;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index(MenuType $menuType)
    {
        $this->authorize('view', $menuType->restaurant);
        $categories = $menuType->categories()->orderBy('display_order')->get();
        return view('menu-categories.index', compact('menuType', 'categories'));
    }

    public function create(MenuType $menuType)
    {
        $this->authorize('update', $menuType->restaurant);
        return view('menu-categories.create', compact('menuType'));
    }

    public function store(Request $request, MenuType $menuType)
    {
        $this->authorize('update', $menuType->restaurant);
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'display_order' => 'nullable|integer',
        ]);

        $menuType->categories()->create($validated);

        return redirect()->route('menu-types.categories.index', $menuType)
            ->with('success', 'Category created successfully.');
    }

    public function edit(MenuType $menuType, MenuCategory $category)
    {
        $this->authorize('update', $menuType->restaurant);
        return view('menu-categories.edit', compact('menuType', 'category'));
    }

    public function update(Request $request, MenuType $menuType, MenuCategory $category)
    {
        $this->authorize('update', $menuType->restaurant);
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'display_order' => 'nullable|integer',
        ]);

        $category->update($validated);

        return redirect()->route('menu-types.categories.index', $menuType)
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(MenuType $menuType, MenuCategory $category)
    {
        $this->authorize('update', $menuType->restaurant);
        $category->delete();

        return redirect()->route('menu-types.categories.index', $menuType)
            ->with('success', 'Category deleted successfully.');
    }
}