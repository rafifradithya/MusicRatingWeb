@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">➕ Tambah Musik</h2>

    <form action="{{ route('admin.musics.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block font-medium">Judul Musik</label>
            <input type="text" name="title" id="title" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="poster" class="block font-medium">Upload Poster</label>
            <input type="file" name="poster" id="poster" class="w-full" accept="image/*" required>
        </div>

        <div class="mb-4">
            <label for="audio" class="block font-medium">Upload Audio (MP3)</label>
            <input type="file" name="audio" id="audio" class="w-full" accept=".mp3" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
