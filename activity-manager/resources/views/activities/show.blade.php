@extends('layouts.app')

@section('content')
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h1>{{ $activity->title }}</h1>

    <p>{{ $activity->description }}</p>

    <p>Tanggal: {{ $activity->activity_date->format('d M Y') }}</p>
    <p>Kategori: {{ $activity->category }}</p>
    <p>Status: {{ $activity->status }}</p>

    <a href="{{ route('activities.edit', $activity) }}">Edit</a> |
    <a href="{{ route('activities.index') }}">Kembali ke Daftar</a>

    <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus Kegiatan</button>
    </form>
@endsection