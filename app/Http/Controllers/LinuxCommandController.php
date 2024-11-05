<?php

namespace App\Http\Controllers;

use App\Models\LinuxCommand;
use Illuminate\Http\Request;

class LinuxCommandController extends Controller
{
    public function index()
    {
        $commands = LinuxCommand::all()->groupBy('category');
        return view('commands.index', compact('commands'));
    }

    public function create()
    {
        $categories = LinuxCommand::distinct()->pluck('category')->sort()->values();

        return view('commands.create', compact('categories'));
//        return view('commands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'command' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'examples' => 'required|array',
            'flags' => 'required|array'
        ]);

        LinuxCommand::create($validated);

        return redirect()->route('commands.index')
            ->with('success', 'Command created successfully');
    }

    public function edit($id)
    {
        $command = LinuxCommand::findOrFail($id);
        return view('commands.edit', compact('command'));
    }

    public function update(Request $request, $id)
    {
        $command = LinuxCommand::findOrFail($id);

        $validated = $request->validate([
            'command' => 'string|max:255',
            'description' => 'string',
            'category' => 'string|max:100',
            'examples' => 'array',
            'flags' => 'array'
        ]);

        $command->update($validated);

        return redirect()->route('commands.index')
            ->with('success', 'Command updated successfully');
    }

    public function destroy($id)
    {
        $command = LinuxCommand::findOrFail($id);
        $command->delete();

        return redirect()->route('commands.index')
            ->with('success', 'Command deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $commands = LinuxCommand::where('command', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();
        return view('commands.search', compact('commands', 'query'));
    }
}
//    public function index()
//    {
//        $commands = LinuxCommand::all()->groupBy('category');
//        return view('commands.index', compact('commands'));
//    }

// function search(Request $request)
//    {
//        $query = $request->get('q');
//        $commands = LinuxCommand::where('command', 'LIKE', "%{$query}%")
//            ->orWhere('description', 'LIKE', "%{$query}%")
//            ->get();
//        return view('commands.search', compact('commands', 'query'));
//    }

