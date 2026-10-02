@extends('layouts.app')

@section('content')
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h1>{{ $activity->title }}</h1>

    <p>{{ $activity->description }}</p>

    <p>Tanggal: {{ $activity->activity_date->format('d M Y') }}</p>
    <p>Kategori: {{ $activity->category->name }}</p>
    <p>Status: {{ $activity->status }}</p>

    @if ($activity->status === 'Draft')
        <form action="{{ route('activities.publish', $activity) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Publish</button>
        </form>
    @endif

    @if ($activity->status === 'Published')
        <form action="{{ route('activities.complete', $activity) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Complete</button>
        </form>
    @endif

    <div style="margin-top: 15px;">
        <a href="{{ route('activities.edit', $activity) }}">Edit</a> |
        <a href="{{ route('activities.index') }}">Kembali ke Daftar</a>
    </div>


    <form action="{{ route('activities.destroy', $activity) }}" method="POST"
        onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus Kegiatan</button>
    </form>
@endsection