<x-form-field name="title" label="Judul" />
<x-form-textarea name="description" label="Deskripsi" />
<x-form-field name="activity_date" label="Tanggal" type="date" />
<x-form-field name="code" label="Kode" />
<div>
    <label for="code">Kode Kegiatan:</label><br>
    <input type="text" id="code" name="code" value="{{ old('code', $activity->code ?? '') }}" style="width: 320px;">
    @error('code')
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-top: 10px;">
    <label for="category_id">Kategori:</label><br>
    <select id="category_id" name="category_id" style="width: 330px;">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $activity->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>
<x-form-field name="status" label="Status" />