<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display all tasks.
     */
    public function index(): View
    {
        return view('tasks.index', [
            'tasks' => Task::query()->latest()->get(),
        ]);
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'string'],
        ]);

        Task::create($validated);

        return to_route('tasks.index')
            ->with('success', 'Task created successfully.');
    }
}
