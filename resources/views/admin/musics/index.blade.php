@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">🎵 Daftar Musik</h2>

    <a href="{{ route('admin.musics.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mb-4 inline-block">
        + Tambah Musik
    </a>

    @if ($musics->isEmpty())
        <p class="text-gray-600">Tidak ada musik tersedia.</p>
    @else
        <ul class="space-y-4">
            @foreach ($musics as $music)
                <li class="bg-white p-4 rounded shadow">
                    <strong class="block text-lg">{{ $music->title }}</strong>

                    @if ($music->poster)
                        <img src="{{ asset('storage/' . $music->poster) }}" alt="Poster" class="w-32 mt-2">
                    @endif

                    @if ($music->audio)
                        <audio controls class="mt-2">
                            <source src="{{ asset('storage/' . $music->audio) }}" type="audio/mpeg">
                        </audio>
                    @endif

                    <div class="mt-2">
                        <a href="{{ route('admin.musics.edit', $music->id) }}" class="text-blue-500 hover:underline mr-3">✏️ Edit</a>

                        <form action="{{ route('admin.musics.destroy', $music->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus musik ini?')">🗑️ Hapus</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
