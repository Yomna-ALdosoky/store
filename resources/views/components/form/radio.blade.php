@props([
    'name',
    'label' => '',
    'options',
    'checked' => false
])

@if ($label)
    <label class="form-label">{{ $label }}</label>
@endif

@foreach($options as $value => $text)
    <div class="form-check">
        <input 
            class="form-check-input" 
            type="radio" 
            name="{{ $name }}" 
            value="{{ $value }}"
            {{ $attributes->class([
                'form-check-input',
                'is-invalid' => $errors->has($name)
            ]) }}
            @checked(old($name, $checked) == $value)
        >
        <label class="form-check-label" for="{{ $name }}_{{ $value }}">
            {{ $text }}
        </label>
    </div>
@endforeach
