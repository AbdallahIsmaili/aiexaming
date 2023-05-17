@props(['id', 'name', 'rows' => 3])

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $slot }}
    </label>

    <div class="mt-1">
        <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
    </div>
</div>
