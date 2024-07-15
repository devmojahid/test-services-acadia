{{-- <div class="widget image-widget editable">
    <label for="{{ $key }}">{{ $control['label'] }}</label>
    <input type="file" accept="image/*" name="{{ $key }}" id="{{ $key }}"
        value="{{ $control['default'] }}">
</div> --}}

<div class="control-group">
    <label for="{{ $key }}">{{ $control['label'] }}</label>
    <input type="file" name="{{ $key }}" id="{{ $key }}" accept="image/*">
    <img id="{{ $key }}-preview" src="{{ $control['default'] }}" alt="Preview" style="max-width: 100px;">
</div>

{{-- 
<div class="control-group">
    <label for="image-upload">Upload Image</label>
    <input type="file" id="image-upload">
    <img id="image-upload-preview" src="#" alt="Image Preview">
    <input type="hidden" id="image-upload-url">
</div> --}}
