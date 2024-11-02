@props(['name', 'options', 'selected' => null])

<div class="form-group">
    <label for="{{ $name }}">{{ ucfirst($name) }}</label> 
    <select 
        name="{{ $name }}" 
        id="{{ $name }}" 
        {{ $attributes->class([
            'form-control',
            'form-select',
            'is-invalid' => $errors->has($name)
        ]) }}
    >
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>    
        @endforeach
    </select> 

    <x-form.validation-feedback :name="$name" />
</div>
