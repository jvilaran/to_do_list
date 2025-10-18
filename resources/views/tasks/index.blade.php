@extends('layouts.app')

@section('title', 'Mis Tareas')

@section('content')
<div class="p-6">
    {{-- Header with title and stats --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="bg-gray-900 text-2xl font-bold text-white">My Tasks</h1>
            @if($tasks->count() > 0)
                <p class="text-gray-500 mt-1">You have {{ $tasks->count() }} {{ $tasks->count() === 1 ? 'task' : 'tasks' }} registered</p>
            @endif
        </div>
    </div>

    @if($tasks->count() > 0)
        {{-- Responsive card view --}}
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($tasks as $task)
                <div class="bg-gray-900 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="bg-gray-900 p-5">
                        {{-- Visual status --}}
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($task->status === 'completed') bg-green-100 text-green-800
                                @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                @if($task->status === 'completed') <i class="fa-solid fa-check"></i> Completed
                                @elseif($task->status === 'in_progress') <i class="fa-solid fa-hourglass-start"></i> In Progress
                                @else <i class="fa-solid fa-spinner"></i> Pending
                                @endif
                            </span>
                        </div>

                        {{-- Content --}}
                        <h3 class="text-lg font-medium text-white mb-2">{{ $task->title }}</h3>
                        <p class="text-gray-400 text-sm mb-4 line-clamp-3">{{ $task->description }}</p>
                        
                        {{-- Date --}}
                        <p class="text-xs text-gray-400 mb-4">
                            <i class="fa-solid fa-calendar"></i> Created: {{ $task->created_at->format('d/m/Y H:i') }}
                        </p>

                        {{-- Actions --}}
                        <div class="flex space-x-2">
                            <a href="/tasks/{{ $task->id }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-md hover:bg-indigo-100 transition-colors">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            <a href="/tasks/{{ $task->id }}/edit" 
                               class="inline-flex items-center px-3 py-1.5 bg-yellow-50 text-yellow-700 text-sm font-medium rounded-md hover:bg-yellow-100 transition-colors">
                                <i class="fa-solid fa-pencil-alt"></i> Edit
                            </a>
                            <button onclick="confirmDelete({{ $task->id }})"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 text-sm font-medium rounded-md hover:bg-red-100 transition-colors">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="hidden xl:block mt-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-900">
                    <thead class="bg-indigo-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Task</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200 divide-y divide-gray-200">
                        @foreach($tasks as $task)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                                    <div class="text-sm text-gray-500 truncate max-w-xs">{{ $task->description }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($task->status === 'completed') bg-green-100 text-green-800
                                    @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else text-gray-800
                                    @endif">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $task->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                <a href="/tasks/{{ $task->id }}" class="text-blue-600 hover:text-blue-900">View</a>
                                <a href="/tasks/{{ $task->id }}/edit" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                <button onclick="confirmDelete({{ $task->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        {{-- Estado vacío --}}
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📝</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No tienes tareas aún</h3>
            <p class="text-gray-600 mb-6">¡Comienza creando tu primera tarea para organizarte mejor!</p>
            <a href="/tasks/create" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors shadow-sm">
                ➕ Crear mi primera tarea
            </a>
        </div>
    @endif
</div>

{{-- JavaScript para confirmación de eliminación --}}
<script>
function confirmDelete(taskId) {
    if (confirm('¿Estás seguro de que quieres eliminar esta tarea? Esta acción no se puede deshacer.')) {
        // Aquí implementarás la eliminación
        alert('Función de eliminación pendiente de implementar');
    }
}
</script>
@endsection