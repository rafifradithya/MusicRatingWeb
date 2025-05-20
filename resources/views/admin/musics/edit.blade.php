@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">✏️ Edit Musik</h2>

    <form action="{{ route('admin.musics.update', $music->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block font-medium">Judul Musik</label>
            <input type="text" name="title" id="title" value="{{ old('title', $music->title) }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Poster Saat Ini</label>
            <img src="{{ asset('storage/' . $music->poster) }}" class="w-32 mb-2">
            <input type="file" name="poster" class="w-full">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Audio Saat Ini</label>
            <audio controls class="mt-2">
                <source src="{{ asset('storage/' . $music->audio) }}" type="audio/mpeg">
            </audio>
            <input type="file" name="audio" class="w-full mt-2" accept=".mp3">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
