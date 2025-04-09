<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class RestaurantController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $restaurants = Restaurant::with('user')->get();
        } else {
            $restaurants = $user->restaurants;
        }

        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => ['nullable', Rule::unique('restaurants', 'slug')],
            'description' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'background_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'text_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'button_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'logo' => ['nullable', 'image', 'max:1024'],
        ]);
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $validated['user_id'] = auth()->id();

        Restaurant::create($validated);

        return redirect()->route('restaurants.index')->with('success', 'Restaurant created successfully.');
    }

    public function edit(Restaurant $restaurant)
    {
        $this->authorize('update', $restaurant);
        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $this->authorize('update', $restaurant);


        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => ['nullable', Rule::unique('restaurants')->ignore($restaurant->id)],
            'description' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'background_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'text_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'button_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'logo' => ['nullable', 'image', 'max:1024'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('logo')) {
            if ($restaurant->logo) {
                Storage::disk('public')->delete($restaurant->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $restaurant->update($validated);

        return redirect()->route('restaurants.index')->with('success', 'Restaurant updated successfully.');
    }

    public function destroy(Restaurant $restaurant)
    {
        $this->authorize('delete', $restaurant);

        if ($restaurant->logo) {
            Storage::disk('public')->delete($restaurant->logo);
        }

        $restaurant->delete();

        return redirect()->route('restaurants.index')->with('success', 'Restaurant deleted successfully.');
    }

    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
        $menuTypes = $restaurant->menuTypes()->with([
            'categories' => function ($query) {
                $query->orderBy('display_order');
            },
            'categories.menuItems' => function ($query) {
                $query->where('is_available', true);
            }
        ])->orderBy('display_order')->get();

        return view('restaurants.menu', compact('restaurant', 'menuTypes'));
    }
}