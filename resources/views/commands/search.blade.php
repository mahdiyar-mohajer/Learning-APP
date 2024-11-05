@extends('layouts.app')
@section('title', 'Linux')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
                Search Results: "{{ $query }}"
            </h1>
            <div class="flex flex-col sm:flex-row gap-4">
                <form action="{{ route('commands.search') }}" method="GET" class="flex w-full sm:w-auto">
                    <div class="relative flex-grow">
                        <input type="text"
                               name="q"
                               placeholder="Search commands..."
                               class="w-full border border-gray-300 rounded-l-lg px-4 py-2.5 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ $query }}">
                        <button type="submit" class="absolute right-0 top-0 h-full px-3 flex items-center text-gray-500 hover:text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                    <a href="{{ route('commands.create') }}"
                       class="inline-flex items-center bg-blue-600 text-white px-4 py-2.5 rounded-r-lg hover:bg-blue-700 transition duration-200 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Command
                    </a>
                </form>
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

        @if($commands->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-500">
                No commands found matching your search.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($commands as $command)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 overflow-hidden">
                        <!-- Command Header -->
                        <div class="p-5 border-b border-gray-100">
                            <div class="flex justify-between items-start">
                                <h3 class="font-mono text-lg font-semibold text-gray-800">{{ $command->command }}</h3>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('commands.edit', $command->id) }}"
                                       class="p-1.5 rounded-md hover:bg-gray-100 text-gray-500 hover:text-blue-600 transition-colors duration-200"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('commands.destroy', $command->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this command?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-1.5 rounded-md hover:bg-gray-100 text-gray-500 hover:text-red-600 transition-colors duration-200"
                                                title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="mt-2 text-gray-600 text-sm">{{ $command->description }}</p>
                        </div>

                        <!-- Command Details -->
                        <div class="p-5 space-y-4">
                            @if($command->examples)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Examples
                                    </h4>
                                    <ul class="space-y-2">
                                        @foreach($command->examples as $example)
                                            <li class="text-sm text-gray-600 bg-gray-50 rounded-md p-2 font-mono">
                                                {{ $example }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($command->flags)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                                        </svg>
                                        Flags
                                    </h4>
                                    <div class="grid grid-cols-1 gap-2">
                                        @foreach($command->flags as $flag => $description)
                                            <div class="text-sm bg-gray-50 rounded-md p-2">
                                                <span class="font-mono text-blue-600 font-medium">{{ $flag }}</span>
                                                <span class="text-gray-500 mx-2">-</span>
                                                <span class="text-gray-600">{{ $description }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
