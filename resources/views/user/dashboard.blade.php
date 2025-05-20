@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">🎧 Daftar Musik</h2>

    @if ($musics->isEmpty())
        <p class="text-gray-600">Tidak ada musik tersedia.</p>
    @else
        <ul class="space-y-6">
            @foreach ($musics as $music)
                <li class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-semibold">{{ $music->title }}</h3>

                    @if ($music->poster)
                        <img src="{{ asset('storage/' . $music->poster) }}" alt="Poster" class="w-32 mt-2 mb-2">
                    @endif

                    @if ($music->audio)
                        <audio controls class="w-full mb-2">
                            <source src="{{ asset('storage/' . $music->audio) }}" type="audio/mpeg">
                            Browser Anda tidak mendukung pemutar audio.
                        </audio>
                    @endif

                    {{-- Komentar dan rating pengguna --}}
                    @auth
                        @php
                            $userRating = $music->ratings->where('user_id', auth()->id())->first();
                        @endphp

                        @if ($userRating)
                            <p class="text-sm">✅ Anda telah memberi {{ $userRating->like ? 'Like' : 'Dislike' }}</p>
                            @if ($userRating->comment)
                                <p class="text-sm italic">"{{ $userRating->comment }}"</p>
                            @endif
                        @else
                            <form action="{{ route('rating.store', $music->id) }}" method="POST" class="mt-2">
                                @csrf
                                <label class="mr-2">
                                    <input type="radio" name="like" value="1" required> 👍 Like
                                </label>
                                <label class="mr-2">
                                    <input type="radio" name="like" value="0"> 👎 Dislike
                                </label>
                                <br>
                                <textarea name="comment" class="border rounded w-full mt-2 p-2" placeholder="Tulis komentar..."></textarea>
                                <button type="submit" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded">Kirim</button>
                            </form>
                        @endif
                    @endauth

                    {{-- Daftar komentar --}}
                    @foreach ($music->ratings as $rating)
                        @if ($rating->comment)
                            <div class="mt-2 p-2 bg-gray-100 rounded text-sm">
                                <strong>{{ $rating->user->name }}:</strong> {{ $rating->comment }}

                                @if ($rating->user_id == auth()->id())
                                    <div class="mt-1">
                                        <a href="{{ route('rating.edit', $rating->id) }}" class="text-blue-600 text-xs">✏️ Edit</a>
                                        <form action="{{ route('rating.destroy', $rating->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 text-xs" onclick="return confirm('Hapus komentar?')">🗑️ Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
