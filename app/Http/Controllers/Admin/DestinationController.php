<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->get();
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:pulau,gunung,diving,wildlife,adventure,other',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slug = Str::slug($request->name);

        $imagePath = $request->file('image')->store('destinations', 'public');

        Destination::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'category' => $request->category,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:pulau,gunung,diving,wildlife,adventure,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slug = Str::slug($request->name);

        $imagePath = $destination->image_url;
        if ($request->hasFile('image')) {
            if ($destination->image_url) {
                Storage::disk('public')->delete($destination->image_url);
            }
            $imagePath = $request->file('image')->store('destinations', 'public');
        }

        $destination->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'category' => $request->category,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil diperbarui!');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image_url) {
            Storage::disk('public')->delete($destination->image_url);
        }
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil dihapus!');
    }
}