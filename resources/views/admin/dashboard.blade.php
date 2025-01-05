@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Manage Users</h1>

        <table class="min-w-full bg-white shadow rounded overflow-hidden">
            <thead>
            <tr class="bg-gray-200">
                <th class="text-left py-3 px-4">ID</th>
                <th class="text-left py-3 px-4">Name</th>
                <th class="text-left py-3 px-4">Email</th>
                <th class="text-left py-3 px-4">Role</th>
                <th class="text-left py-3 px-4">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $user->id }}</td>
                    <td class="py-3 px-4">{{ $user->name }}</td>
                    <td class="py-3 px-4">{{ $user->email }}</td>
                    <td class="py-3 px-4 capitalize">{{ $user->role }}</td> <!-- Display role -->
                    <td class="py-3 px-4 flex gap-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500" title="Edit">
                            <i class="fas fa-edit"></i> <!-- Font Awesome Edit Icon -->
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" title="Delete">
                                <i class="fas fa-trash-alt"></i> <!-- Font Awesome Trash Icon -->
                            </button>
                        </form>

                        <!-- Deactivate/Reactivate Button -->
                        @if($user->active)
                            <form action="{{ route('admin.users.deactivate', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-yellow-500" title="Deactivate">
                                    <i class="fas fa-ban"></i> <!-- Font Awesome Ban Icon -->
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.activate', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-green-500" title="Reactivate">
                                    <i class="fas fa-check"></i> <!-- Font Awesome Check Icon -->
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection
