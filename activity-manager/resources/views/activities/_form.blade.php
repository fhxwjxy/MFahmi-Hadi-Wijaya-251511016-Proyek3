<div>
    <label for="title">Judul:</label><br>
    <input type="text" id="title" name="title" value="{{ old('title', $activity->title ?? '') }}" style="width: 320px;">
    @error('title')
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-top: 10px;">
    <label for="description">Deskripsi:</label><br>
    <textarea id="description" name="description" rows="3" style="width: 320px;">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-top: 10px;">
    <label for="activity_date">Tanggal:</label><br>
    <input type="date" id="activity_date" name="activity_date" value="{{ old('activity_date', $activity->activity_date ?? '') }}">
    @error('activity_date')
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-top: 10px;">
    <label for="category">Kategori:</label><br>
    <input type="text" id="category" name="category" value="{{ old('category', $activity->category ?? '') }}">
    @error('category')
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-top: 10px;">
    <label for="status">Status:</label><br>
    <input type="text" id="status" name="status" value="{{ old('status', $activity->status ?? '') }}">
    @error('status')
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>