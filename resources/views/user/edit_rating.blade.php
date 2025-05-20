@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">✏️ Edit Rating</h2>

    <form action="{{ route('rating.update', $rating->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Rating:</label>
            <label><input type="radio" name="like" value="1" {{ $rating->like ? 'checked' : '' }}> 👍 Like</label>
            <label class="ml-4"><input type="radio" name="like" value="0" {{ !$rating->like ? 'checked' : '' }}> 👎 Dislike</label>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Komentar:</label>
            <textarea name="comment" rows="4" class="w-full border p-2 rounded">{{ old('comment', $rating->comment) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Update</button>
        <a href="/dashboard" class="ml-4 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
