<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Music;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::all();
        return view('admin.musics.index', compact('musics'));
    }

    public function create()
    {
        return view('admin.musics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'audio' => 'required|mimes:mp3|max:10000',
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');
        $audioPath = $request->file('audio')->store('audios', 'public');

        Music::create([
            'title' => $request->title,
            'poster' => $posterPath,
            'audio' => $audioPath,
        ]);

        return redirect()->route('admin.musics.index')->with('success', 'Musik berhasil ditambahkan!');
    }

    public function edit(Music $music)
    {
        return view('admin.musics.edit', compact('music'));
    }

    public function update(Request $request, Music $music)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'audio' => 'nullable|mimes:mp3|max:10000',
        ]);

        $data = ['title' => $request->title];

        // Hapus dan update poster jika diupload
        if ($request->hasFile('poster')) {
            if ($music->poster && Storage::disk('public')->exists($music->poster)) {
                Storage::disk('public')->delete($music->poster);
            }
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        // Hapus dan update audio jika diupload
        if ($request->hasFile('audio')) {
            if ($music->audio && Storage::disk('public')->exists($music->audio)) {
                Storage::disk('public')->delete($music->audio);
            }
            $data['audio'] = $request->file('audio')->store('audios', 'public');
        }

        $music->update($data);

        return redirect()->route('admin.musics.index')->with('success', 'Musik berhasil diperbarui!');
    }

    public function destroy(Music $music)
    {
        // Hapus poster jika ada
        if ($music->poster && Storage::disk('public')->exists($music->poster)) {
            Storage::disk('public')->delete($music->poster);
        }

        // Hapus audio jika ada
        if ($music->audio && Storage::disk('public')->exists($music->audio)) {
            Storage::disk('public')->delete($music->audio);
        }

        // Hapus data dari DB
        $music->delete();

        return redirect()->route('admin.musics.index')->with('success', 'Musik berhasil dihapus!');
    }
}
