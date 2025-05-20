<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Music;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Music $music)
    {
        $request->validate([
            'like' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        // Cegah user memberi rating lebih dari 1x
        $existing = Rating::where('user_id', Auth::id())->where('music_id', $music->id)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah memberi rating untuk musik ini.');
        }

        Rating::create([
            'user_id' => Auth::id(),
            'music_id' => $music->id,
            'like' => $request->like,
            'comment' => $request->comment,
        ]);

        return redirect('/dashboard')->with('success', 'Rating berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rating = Rating::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.edit_rating', compact('rating'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'like' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        $rating = Rating::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $rating->update([
            'like' => $request->like,
            'comment' => $request->comment,
        ]);

        return redirect('/dashboard')->with('success', 'Rating berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rating = Rating::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $rating->delete();

        return redirect('/dashboard')->with('success', 'Rating berhasil dihapus.');
    }
}
