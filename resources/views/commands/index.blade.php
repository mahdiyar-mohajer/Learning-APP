@extends('layouts.app')
@section('title', 'Linux')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Linux Commands Library</h1>
            <div class="flex flex-col sm:flex-row gap-4">
                <form action="{{ route('commands.search') }}" method="GET" class="flex w-full sm:w-auto">
                    <div class="relative flex-grow">
                        <input type="text" name="q" placeholder="Search commands..."
                               class="w-full border border-gray-300 rounded-l-lg px-4 py-2.5 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ request('q') }}">
                        <button type="submit"
                                class="absolute right-0 top-0 h-full px-3 flex items-center text-gray-500 hover:text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                    <a href="{{ route('commands.create') }}"
                       class="inline-flex items-center bg-blue-600 text-white px-4 py-2.5 rounded-r-lg hover:bg-blue-700 transition duration-200 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Command
                    </a>
                </form>
            </div>
        </div>

        @foreach($commands as $category => $categoryCommands)
            <div class="mb-12">
                <div class="flex items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $category }}</h2>
                    <div class="ml-4 h-px bg-gray-200 flex-grow"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categoryCommands as $command)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-visible relative">
                            <div class="p-5 border-b border-gray-100">
                                <h3
                                    class="font-mono text-lg font-semibold text-gray-800 cursor-pointer hover:text-blue-600"
                                    onclick="copyToClipboard('{{ $command->command }}')">
                                    {{ $command->command }}
                                </h3>
                                <p class="mt-2 text-gray-600 text-sm">{{ $command->description }}</p>
                            </div>
                            <div class="p-5 space-y-4">
                                @if($command->examples)
                                    <div id="copy-success-popup"
                                         class="fixed bottom-4 right-4 bg-green-500 text-white p-3 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
                                        <span id="copy-success-message">Copied to clipboard!</span>
                                    </div>
                                    <div class="relative group">
                                        <button
                                            class="example-button text-sm font-semibold text-gray-700 flex items-center hover:text-blue-600">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            Examples
                                            <svg
                                                class="w-3 h-3 ml-2 text-gray-500 transform transition-transform duration-300 group-hover:rotate-180"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div
                                            class="example-popup absolute top-full left-0 mt-2 bg-white border rounded-lg shadow-lg p-4 w-64 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 hidden group-hover:block">
                                            <h4 class="font-semibold text-gray-800 mb-2">Examples:</h4>
                                            <ul class="space-y-2">
                                                @foreach($command->examples as $example)
                                                    <li
                                                        class="text-sm text-gray-600 bg-gray-50 rounded-md p-2 font-mono cursor-pointer"
                                                        onclick="copyToClipboard('{{ $example }}')">
                                                        {{ $example }}

                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="relative group">
                                        <button
                                            class="flag-button text-sm font-semibold text-gray-700 flex items-center hover:text-blue-600">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                            </svg>
                                            Flags
                                            <svg
                                                class="w-3 h-3 ml-2 text-gray-500 transform transition-transform duration-300 group-hover:rotate-180"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div
                                            class="flag-popup absolute top-full left-0 mt-2 bg-white border rounded-lg shadow-lg p-4 w-64 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 hidden group-hover:block">
                                            <h4 class="font-semibold text-gray-800 mb-2">Flags:</h4>
                                            <div class="space-y-2">
                                                @foreach($command->flags as $flag => $description)
                                                    <div
                                                        class="text-sm bg-gray-50 rounded-md p-2 cursor-pointer"
                                                        onclick="copyToClipboard('{{ $flag }} - {{ $description }}')">
                                                        <span
                                                            class="font-mono text-blue-600 font-medium">{{ $flag }}</span>
                                                        <span class="text-gray-500 mx-2">-</span>
                                                        <span class="text-gray-600">{{ $description }}</span>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/commands.js') }}"></script>
@endpush

{{-- <script>
    function copyToClipboard(text) {
        var tempTextArea = document.createElement("textarea");
        document.body.appendChild(tempTextArea);
        tempTextArea.value = text;
        tempTextArea.select();
        document.execCommand('copy');
        document.body.removeChild(tempTextArea);

        showCopySuccessPopup();
    }

    function showCopySuccessPopup() {
        const popup = document.getElementById('copy-success-popup');
        popup.classList.remove('opacity-0');
        popup.classList.add('opacity-100');
        setTimeout(() => {
            popup.classList.remove('opacity-100');
            popup.classList.add('opacity-0');
        }, 2000);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function togglePopup(button, popup, className) {
            button.addEventListener('click', function (event) {
                event.stopPropagation();
                closeAllPopups();
                popup.classList.toggle('hidden');
                popup.classList.toggle('opacity-0');
                popup.classList.toggle('opacity-100');
            });
        }

        function closeAllPopups() {
            document.querySelectorAll('.example-popup, .flag-popup').forEach(function (popup) {
                popup.classList.add('hidden');
                popup.classList.remove('opacity-100');
                popup.classList.add('opacity-0');
            });
        }

        function closePopupsOnClickOutside(popup) {
            document.addEventListener('click', function (event) {
                if (!popup.contains(event.target) && !popup.previousElementSibling.contains(event.target)) {
                    popup.classList.add('hidden');
                    popup.classList.remove('opacity-100');
                    popup.classList.add('opacity-0');
                }
            });
        }


        document.querySelectorAll('.example-button').forEach(function (button) {
            const popup = button.nextElementSibling;
            togglePopup(button, popup, 'example-popup');
            closePopupsOnClickOutside(popup);
        });


        document.querySelectorAll('.flag-button').forEach(function (button) {
            const popup = button.nextElementSibling;
            togglePopup(button, popup, 'flag-popup');
            closePopupsOnClickOutside(popup);
        });
    });
</script> --}}





