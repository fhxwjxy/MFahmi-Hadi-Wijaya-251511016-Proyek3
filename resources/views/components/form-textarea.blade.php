@props(['name', 'label', 'rows' => 3])

<div style="margin-top: 10px;">
    <label for="{{ $name }}">{{ $label }}:</label><br>
    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" style="width: 320px;">{{ old($name, $activity->{$name} ?? '') }}</textarea>
    @error($name)
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>