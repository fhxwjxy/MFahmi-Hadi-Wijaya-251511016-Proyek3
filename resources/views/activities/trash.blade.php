@extends('layouts.app')

@section('content')
    <h1>Sampah (Trash)</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('activities.index') }}">Kembali ke Daftar Aktif</a>

    <ul style="margin-top: 15px;">
        @forelse ($activities as $activity)
            <li style="margin-bottom: 10px;">
                <strong>{{ $activity->title }}</strong> ({{ $activity->code }}) —
                Kategori: {{ $activity->category->name }} —
                Dihapus pada: {{ $activity->deleted_at->format('d M Y H:i') }}

                <form action="{{ route('activities.restore', $activity->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Pulihkan</button>
                </form>

                <form action="{{ route('activities.force-delete', $activity->id) }}" method="POST" style="display:inline;"
                    onsubmit="return confirm('Hapus permanen? Tidak bisa dibatalkan!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus Permanen</button>
                </form>
            </li>
        @empty
            <li>Trash kosong.</li>
        @endforelse
    </ul>

    <div style="margin-top: 15px;">
        {{ $activities->links() }}
    </div>
@endsection