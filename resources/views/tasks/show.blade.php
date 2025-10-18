@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="max-w-4xl mx-auto p-6">
    {{-- Header con título y botones de acción --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 pb-6 border-b border-gray-200">
        <div class="flex-1">
            <div class="flex items-center mb-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mr-3
                    @if($task->status === 'completed') bg-green-100 text-green-800
                    @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    @if($task->status === 'completed') ✅ Completada
                    @elseif($task->status === 'in_progress') ⏳ En Progreso
                    @else 📝 Pendiente
                    @endif
                </span>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $task->title }}</h1>
            
            <div class="flex items-center text-sm text-gray-500 space-x-4">
                <span class="flex items-center">
                    📅 Creada: {{ $task->created_at->format('d/m/Y H:i') }}
                </span>
                @if($task->updated_at->ne($task->created_at))
                    <span class="flex items-center">
                        🔄 Actualizada: {{ $task->updated_at->format('d/m/Y H:i') }}
                    </span>
                @endif
            </div>
        </div>

        {{-- Botones de acción --}}
        <div class="flex items-center space-x-3 mt-4 sm:mt-0">
            <a href="/tasks/{{ $task->id }}/edit" 
               class="inline-flex items-center px-4 py-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-700 font-medium rounded-lg border border-yellow-200 transition-colors">
                ✏️ Editar
            </a>
            
            <button onclick="confirmDelete({{ $task->id }})"
                    class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-medium rounded-lg border border-red-200 transition-colors">
                🗑️ Eliminar
            </button>
            
            <a href="/tasks" 
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-300 transition-colors">
                ← Volver
            </a>
        </div>
    </div>

    {{-- Contenido principal --}}
    <div class="grid gap-8 lg:grid-cols-3">
        {{-- Descripción principal --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 flex items-center">
                        📄 Descripción
                    </h2>
                </div>
                <div class="px-6 py-4">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $task->description }}</p>
                </div>
            </div>

            {{-- Historial de cambios (futuro) --}}
            <div class="mt-6 bg-white rounded-lg border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 flex items-center">
                        📈 Actividad
                    </h2>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 text-sm">📝</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">
                                <span class="font-medium">Tarea creada</span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $task->created_at->format('d/m/Y \a \l\a\s H:i') }}
                            </p>
                        </div>
                    </div>

                    @if($task->updated_at->ne($task->created_at))
                        <div class="flex items-start space-x-3 mt-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <span class="text-yellow-600 text-sm">🔄</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">
                                    <span class="font-medium">Tarea actualizada</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $task->updated_at->format('d/m/Y \a \l\a\s H:i') }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Panel lateral con información --}}
        <div class="space-y-6">
            {{-- Información de la tarea --}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">ℹ️ Información</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">ID</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-mono">#{{ $task->id }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Estado actual</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($task->status === 'completed') bg-green-100 text-green-800
                                @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                @if($task->status === 'completed') ✅ Completada
                                @elseif($task->status === 'in_progress') ⏳ En Progreso
                                @else 📝 Pendiente
                                @endif
                            </span>
                        </dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Fecha de creación</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $task->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Última actualización</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $task->updated_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </div>
            </div>

            {{-- Acciones rápidas --}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">⚡ Acciones rápidas</h3>
                </div>
                <div class="px-6 py-4 space-y-3">
                    @if($task->status !== 'completed')
                        <button class="w-full text-left px-3 py-2 text-sm text-green-700 hover:bg-green-50 rounded-md transition-colors">
                            ✅ Marcar como completada
                        </button>
                    @endif
                    
                    @if($task->status !== 'in_progress')
                        <button class="w-full text-left px-3 py-2 text-sm text-yellow-700 hover:bg-yellow-50 rounded-md transition-colors">
                            ⏳ Poner en progreso
                        </button>
                    @endif
                    
                    <a href="/tasks/{{ $task->id }}/edit" 
                       class="block w-full text-left px-3 py-2 text-sm text-blue-700 hover:bg-blue-50 rounded-md transition-colors">
                        ✏️ Editar detalles
                    </a>
                    
                    <button onclick="confirmDelete({{ $task->id }})"
                            class="w-full text-left px-3 py-2 text-sm text-red-700 hover:bg-red-50 rounded-md transition-colors">
                        🗑️ Eliminar tarea
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript para funciones interactivas --}}
<script>
function confirmDelete(taskId) {
    if (confirm('¿Estás seguro de que quieres eliminar esta tarea?\n\nEsta acción no se puede deshacer.')) {
        // Aquí implementarás la eliminación cuando tengas las rutas DELETE
        alert('Función de eliminación pendiente de implementar');
    }
}

// Funciones para cambiar estado rápidamente (para implementar después)
function markAsCompleted(taskId) {
    // Implementar después
    alert('Función para marcar como completada pendiente de implementar');
}

function markAsInProgress(taskId) {
    // Implementar después  
    alert('Función para poner en progreso pendiente de implementar');
}
</script>
@endsection