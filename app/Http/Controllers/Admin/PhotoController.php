<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('admin.photos.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.photos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:bali,papua,jawa_timur,ntt,adventure,other',
            'description' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Photo::create([
            'image_url' => $imagePath,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil diunggah!');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->image_url) {
            Storage::disk('public')->delete($photo->image_url);
        }
        $photo->delete();
        return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil dihapus!');
    }
}