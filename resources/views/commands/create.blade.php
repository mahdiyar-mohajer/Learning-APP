@extends('layouts.app')
@section('title', 'Linux')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header with Back Button -->
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('commands.index') }}"
                   class="p-2 text-gray-500 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Add New Command</h1>
            </div>

            <!-- Main Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <form action="{{ route('commands.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Command Input -->
                    <div>
                        <label for="command" class="block text-sm font-medium text-gray-700 mb-2">Command</label>
                        <input type="text"
                               id="command"
                               name="command"
                               value="{{ old('command') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        @error('command')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Input -->
                    <div>
                        <label for="description"
                               class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description"
                                  name="description"
                                  rows="3"
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


{{--                    <div>--}}
{{--                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>--}}
{{--                        <div class="relative">--}}
{{--                            <select id="category_select"--}}
{{--                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 mb-2"--}}
{{--                                    onchange="handleCategoryChange(this.value)">--}}
{{--                                <option value="">Select Category</option>--}}
{{--                                @foreach($categories as $existingCategory)--}}
{{--                                    <option value="{{ $existingCategory }}"--}}
{{--                                        {{ old('category') == $existingCategory ? 'selected' : '' }}>--}}
{{--                                        {{ $existingCategory }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                                <option value="new">+ Add New Category</option>--}}
{{--                            </select>--}}

{{--                            <div id="new_category_input" class="hidden">--}}
{{--                                <input type="text"--}}
{{--                                       id="category"--}}
{{--                                       name="category"--}}
{{--                                       placeholder="Enter new category"--}}
{{--                                       value="{{ old('category') }}"--}}
{{--                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @error('category')--}}
{{--                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

                    <!-- Examples Section -->

                    <div class="space-y-4">
                        <label for="category" class="block text-sm font-semibold text-gray-700">Category</label>
                        <div class="relative">
                            <select id="category_select"
                                    class="w-full rounded-lg border p-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600 transition duration-200 ease-in-out mb-2"
                                    onchange="handleCategoryChange(this.value)">
                                <option value="" class="text-gray-400">Select Category</option>
                                @foreach($categories as $existingCategory)
                                    <option value="{{ $existingCategory }}"
                                        {{ old('category') == $existingCategory ? 'selected' : '' }}>
                                        {{ $existingCategory }}
                                    </option>
                                @endforeach
                                <option value="new" class="text-blue-600 font-semibold">+ Add New Category</option>
                            </select>

                            <div id="new_category_input" class="hidden mt-2">
                                <input type="text"
                                       id="category"
                                       name="category"
                                       placeholder="Enter new category"
                                       value="{{ old('category') }}"
                                       class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-600 transition duration-200 ease-in-out">
                            </div>
                        </div>
                        @error('category')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="examples-container">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Examples</label>
                        <div class="space-y-3" id="examples-list">
                            <div class="flex items-center gap-2">
                                <input type="text"
                                       name="examples[]"
                                       class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                       placeholder="Enter command example">
                                <button type="button"
                                        onclick="addExample()"
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('examples')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Flags Section -->
                    <div class="flags-container">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Flags</label>
                        <div class="space-y-3" id="flags-list">
                            <div class="flex items-center gap-2">
                                <input type="text"
                                       name="flags[]"
                                       placeholder="Flag (e.g. -l, --help)"
                                       class="w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <input type="text"
                                       name="flag_descriptions[]"
                                       placeholder="Flag description"
                                       class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <button type="button"
                                        onclick="addFlag()"
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('flags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            Create Command
                        </button>
                        <a href="{{ route('commands.index') }}"
                           class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addExample() {
            const container = document.getElementById('examples-list');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2';
            div.innerHTML = `
        <input type="text"
               name="examples[]"
               class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
               placeholder="Enter command example">
        <button type="button"
                onclick="this.parentElement.remove()"
                class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
            </svg>
        </button>
    `;
            container.appendChild(div);
        }

        function addFlag() {
            const container = document.getElementById('flags-list');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2';
            div.innerHTML = `
        <input type="text"
               name="flags[]"
               placeholder="Flag (e.g. -l, --help)"
               class="w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <input type="text"
               name="flag_descriptions[]"
               placeholder="Flag description"
               class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <button type="button"
                onclick="this.parentElement.remove()"
                class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
            </svg>
        </button>
    `;
            container.appendChild(div);
        }
    </script>

    <script>
        function handleCategoryChange(value) {
            const newCategoryInput = document.getElementById('new_category_input');
            const categoryInput = document.getElementById('category');

            if (value === 'new') {
                newCategoryInput.classList.remove('hidden');
                categoryInput.focus();
                categoryInput.value = '';
            } else {
                newCategoryInput.classList.add('hidden');
                categoryInput.value = value;
            }
        }

        // On page load, check if we need to show the new category input
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category_select');
            const newCategoryInput = document.getElementById('new_category_input');

            if (categorySelect.value === 'new') {
                handleCategoryChange('new');
            }

            // Adjust the width of the select element for a more spacious dropdown
            categorySelect.classList.add('w-full');
        });
    </script>

@endsection
