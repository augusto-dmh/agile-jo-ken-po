@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-100 hover:text-gray-300 cursor-pointer']) }}>
    {{ $value ?? $slot }}
</label>
