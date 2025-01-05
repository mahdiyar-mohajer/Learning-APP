@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 border-b">
                <h1 class="text-3xl font-semibold text-gray-700">Edit User</h1>
                <p class="text-sm text-gray-500 mt-1">Make changes to the user information below.</p>
            </div>
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-600">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ $user->name }}"
                        class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-300 focus:outline-none"
                        required>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-600">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ $user->email }}"
                        class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-300 focus:outline-none"
                        required>
                </div>

                <!-- Role Field -->
                <div>
                    <label for="role" class="block text-sm font-semibold text-gray-600">Role</label>
                    <select
                        name="role"
                        id="role"
                        class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-300 focus:outline-none">
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Active Status Field -->
                <div>
                    <label for="active" class="block text-sm font-semibold text-gray-600">Status</label>
                    <select
                        name="active"
                        id="active"
                        class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-300 focus:outline-none">
                        <option value="1" {{ $user->active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$user->active ? 'selected' : '' }}>Deactivated</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center">
                    <button
                        type="submit"
                        class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.users') }}"
                       class="mt-4 sm:mt-0 text-gray-500 hover:text-gray-700 text-sm transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
