@extends('layouts.app')

@section('content')
    <h1>Daftar Kegiatan</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('activities.create') }}">+ Tambah Kegiatan Baru</a> |
    <a href="{{ route('activities.trash') }}">Sampah</a>

    <form action="{{ route('activities.index') }}" method="GET" style="margin-top: 15px;">
        <input type="text" name="search" placeholder="Cari kode atau judul..." value="{{ request('search') }}">

        <select name="category_id">
            <option value="">-- Semua Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="status">
            <option value="">-- Semua Status --</option>
            <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
            <option value="Published" {{ request('status') === 'Published' ? 'selected' : '' }}>Published</option>
            <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <select name="sort">
            <option value="desc" {{ request('sort', 'desc') === 'desc' ? 'selected' : '' }}>Tanggal Terbaru</option>
            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Tanggal Terlama</option>
        </select>

        <button type="submit">Terapkan</button>
        <a href="{{ route('activities.index') }}">Reset</a>
    </form>

    <ul style="margin-top: 15px;">
        @forelse ($activities as $activity)
            <li style="margin-bottom: 10px;">
                <a href="{{ route('activities.show', $activity) }}">
                    <strong>{{ $activity->title }}</strong> ({{ $activity->code }})
                </a><br>
                {{ $activity->activity_date->format('d M Y') }} —
                Kategori: {{ $activity->category->name }} —
                Status: {{ $activity->status }}
            </li>
        @empty
            <li>Belum ada kegiatan.</li>
        @endforelse
    </ul>

    <div style="margin-top: 15px;">
        {{ $activities->links() }}
    </div>
@endsection