@extends('layouts.app')

@section('content')
    <h1>Daftar Kegiatan</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('activities.create') }}">+ Tambah Kegiatan Baru</a>

    <div style="margin-top: 10px;">
        <form action="{{ route('activities.index') }}" method="GET" style="display: inline;">
            <label for="status">Filter Status:</label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">-- Semua --</option>
                <option value="Planned" {{ request('status') === 'Planned' ? 'selected' : '' }}>Planned</option>
                <option value="Ongoing" {{ request('status') === 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="Done" {{ request('status') === 'Done' ? 'selected' : '' }}>Done</option>
            </select>
        </form>

        @if (request()->filled('status'))
            <a href="{{ route('activities.index') }}">Reset Filter</a>
        @endif
    </div>

    <ul>
        @forelse ($activities as $activity)
            <li style="margin-bottom: 10px;">
                <a href="{{ route('activities.show', $activity) }}">
                    <strong>{{ $activity->title }}</strong>
                </a><br>
                {{ $activity->activity_date->format('d M Y') }} — Status: {{ $activity->status }}
            </li>
        @empty
            <li>Belum ada kegiatan.</li>
        @endforelse
    </ul>
@endsection