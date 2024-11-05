@extends('layouts.app')
@section('title', 'Linux')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Edit Command</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('commands.index') }}"
                   class="inline-flex items-center text-gray-600 hover:text-gray-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Commands
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('commands.update', $command->id) }}" method="POST" class="divide-y divide-gray-100">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Command</label>
                        <input type="text"
                               name="command"
                               value="{{ old('command', $command->command) }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono"
                        >
                        @error('command')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description"
                                  rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $command->description) }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <input type="text"
                               name="category"
                               value="{{ old('category', $command->category) }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                        @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Examples Section -->
                <div class="p-6">
                    <div class="mb-4 flex items-center">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h2 class="text-lg font-medium text-gray-900">Examples</h2>
                    </div>

                    <div class="space-y-3" id="examples-list">
                        @foreach($command->examples as $example)
                            <div class="flex gap-2">
                                <input type="text"
                                       name="examples[]"
                                       value="{{ $example }}"
                                       class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button type="button"
                                        onclick="this.parentElement.remove()"
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                        <div class="flex gap-2">
                            <input type="text"
                                   name="examples[]"
                                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="button"
                                    onclick="addExample()"
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-blue-200 text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Flags Section -->
                <div class="p-6">
                    <div class="mb-4 flex items-center">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                        <h2 class="text-lg font-medium text-gray-900">Flags</h2>
                    </div>

                    <div class="space-y-3" id="flags-list">
                        @foreach($command->flags as $flag => $description)
                            <div class="flex gap-2">
                                <input type="text"
                                       name="flags[]"
                                       value="{{ $flag }}"
                                       class="w-1/3 border border-gray-300 rounded-lg px-4 py-2.5 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <input type="text"
                                       name="flag_descriptions[]"
                                       value="{{ $description }}"
                                       class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button type="button"
                                        onclick="this.parentElement.remove()"
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                        <div class="flex gap-2">
                            <input type="text"
                                   name="flags[]"
                                   placeholder="Flag"
                                   class="w-1/3 border border-gray-300 rounded-lg px-4 py-2.5 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <input type="text"
                                   name="flag_descriptions[]"
                                   placeholder="Description"
                                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="button"
                                    onclick="addFlag()"
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-blue-200 text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 py-4 bg-gray-50 flex justify-end gap-4">
                    <a href="{{ route('commands.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Update Command
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addExample() {
            const container = document.getElementById('examples-list');
            const div = document.createElement('div');
            div.className = 'flex gap-2';
            div.innerHTML = `
                <input type="text"
                       name="examples[]"
                       class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="button"
                        onclick="this.parentElement.remove()"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition-colors duration-200">
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
            div.className = 'flex gap-2';
            div.innerHTML = `
                <input type="text"
                       name="flags[]"
                       placeholder="Flag"
                       class="w-1/3 border border-gray-300 rounded-lg px-4 py-2.5 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <input type="text"
                       name="flag_descriptions[]"
                       placeholder="Description"
                       class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="button"
                        onclick="this.parentElement.remove()"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
            `;
            container.appendChild(div);
        }
    </script>
@endsection
