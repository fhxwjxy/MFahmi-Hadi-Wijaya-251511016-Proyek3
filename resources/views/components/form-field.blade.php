@props(['name', 'label', 'type' => 'text'])

<div style="margin-top: 10px;">
    <label for="{{ $name }}">{{ $label }}:</label><br>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
           value="{{ old($name, $activity->{$name} ?? '') }}" style="width: 320px;">
    @error($name)
        <p style="color: red; margin: 4px 0;">{{ $message }}</p>
    @enderror
</div>