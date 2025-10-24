<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Contracts\View\View;

class TaskController extends Controller
{
    // List of tasks
    public function index(): View
    {
        $tasks = Task::all(); // Get all the tasks
        return view('tasks.index', compact('tasks'));
    }

    // Create form
    public function create(): View
    {
        return view('tasks.create');
    }

    // Show specific task
    public function show(string $id): View
    {
        return view('tasks.show', [
            'task' => Task::findOrFail($id)
        ]);
    }

    // Store new task
    public function store(StoreTaskRequest $request)
    {
        // Automatically validated by StoreTaskRequest
        $validated = $request->validated();

        // Create the new task
        Task::create($validated);

        // Redirect with success message
        return redirect('/')->with('success', 'Task created successfully!');
    }

    // Edit form - Show the edit form with current task data
    public function edit($id): View
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // Update task - Process the edit form
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $validated = $request->validated();

        // Update the task
        $task->update($validated);

        // Redirect with success message
        return redirect('/')->with('success', 'Task updated successfully!');
    }

    // Delete task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/')->with('success', 'Task deleted successfully!');
    }
}
