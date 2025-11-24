<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::latest()->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        return view('admin.tours.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'min_people' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'category' => 'required|in:populer,best_seller,premium,rekomendasi,regular',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slug = Str::slug($request->name);

        // Handle upload gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tours', 'public');
        }

        Tour::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'duration_nights' => $request->duration_nights,
            'min_people' => $request->min_people,
            'location' => $request->location,
            'category' => $request->category,
            'image_url' => $imagePath,
            'rating' => 0,
            'reviews_count' => 0,
        ]);

        return redirect()->route('admin.tours.index')->with('success', 'Paket tour berhasil ditambahkan!');
    }

    public function edit(Tour $tour)
    {
        return view('admin.tours.edit', compact('tour'));
    }

    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'min_people' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'category' => 'required|in:populer,best_seller,premium,rekomendasi,regular',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slug = Str::slug($request->name);

        $imagePath = $tour->image_url;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($tour->image_url) {
                \Storage::disk('public')->delete($tour->image_url);
            }
            $imagePath = $request->file('image')->store('tours', 'public');
        }

        $tour->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'duration_nights' => $request->duration_nights,
            'min_people' => $request->min_people,
            'location' => $request->location,
            'category' => $request->category,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.tours.index')->with('success', 'Paket tour berhasil diperbarui!');
    }

    public function destroy(Tour $tour)
    {
        // Hapus gambar jika ada
        if ($tour->image_url) {
            \Storage::disk('public')->delete($tour->image_url);
        }
        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Paket tour berhasil dihapus!');
    }
}