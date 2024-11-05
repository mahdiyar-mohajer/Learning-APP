@extends('layouts.app')

@section('title', 'Rightel Learning Application')
@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="mt-4 text-4xl font-extrabold text-gray-900 sm:text-5xl">
                    Welcome to TechLearning
                </h1>
                <p class="mt-4 text-xl text-gray-500">
                    Start your learning journey with our comprehensive tutorials
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($features as $feature)
                        <div class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                            <div>
                        <span class="rounded-lg inline-flex p-3 bg-indigo-50 text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M{{ $feature['icon'] === 'terminal' ? '4 6h16M4 12h16M4 18h16' : ($feature['icon'] === 'code' ? '10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4' : '4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4') }}" />
                            </svg>
                        </span>
                            </div>
                            <div class="mt-8">
                                <h3 class="text-lg font-medium">
                                    @if($feature['available'])
                                        <a href="{{ route($feature['route']) }}" class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{ $feature['title'] }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">{{ $feature['title'] }} (Coming Soon)</span>
                                    @endif
                                </h3>
                                <p class="mt-2 text-sm text-gray-500">
                                    {{ $feature['description'] }}
                                </p>
                            </div>
                            @if($feature['available'])
                                <span class="pointer-events-none absolute top-6 right-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
