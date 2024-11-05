<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index()
    {
        $features = [
            [
                'icon' => 'terminal',
                'title' => 'Linux Commands',
                'description' => 'Master essential Linux commands with hands-on examples',
                'route' => 'commands.index',
                'available' => true,
            ],
            [
                'icon' => 'code',
                'title' => 'Programming',
                'description' => 'Learn programming fundamentals and best practices',
                'route' => '#',
                'available' => false,
            ],
            [
                'icon' => 'database',
                'title' => 'Databases',
                'description' => 'Understand database concepts and management',
                'route' => '#',
                'available' => false,
            ],
        ];

        return view('home', compact('features'));
    }

    public function commands()
    {
        return view('commands.index');
    }
}
