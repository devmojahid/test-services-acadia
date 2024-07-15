<div class="control-group">
    <label for="{{ $name }}">{{ $control['label'] }}</label>
    <select name="{{ $name }}" id="{{ $name }}">
        @foreach ($control['options'] as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @if ($optionValue == $value) selected @endif>{{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
