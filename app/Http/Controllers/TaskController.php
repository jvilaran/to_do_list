<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use function Psy\debug;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::all(); // Obtener todas las tareas
        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        return view('tasks.create'); // Mostrar formulario de creación
    }

    public function show(string $id): View
    {
        return view('tasks.show', [
            'task' => Task::findOrFail($id)
        ]);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,completed,in_progress'
        ]);

        // Crear la nueva tarea
        Task::create($validated);

        // Redireccionar con mensaje de éxito
        return redirect('/tasks')->with('success', 'Task created successfully!');
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
