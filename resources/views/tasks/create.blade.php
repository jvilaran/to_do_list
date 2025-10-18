@extends('layouts.app')

@section('title', 'Crear Nueva Tarea')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">✨ Crear Nueva Tarea</h1>
        <p class="text-gray-600 mt-2">Completa los campos para agregar una nueva tarea a tu lista</p>
    </div>

    {{-- Formulario --}}
    <form action="/tasks" method="POST" class="space-y-6">
        @csrf
        
        {{-- Campo Título --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                📝 Título de la tarea *
            </label>
            <input type="text" 
                   name="title" 
                   id="title" 
                   placeholder="Ej: Completar proyecto de Laravel"
                   value="{{ old('title') }}" 
                   required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors
                          @error('title') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Campo Descripción --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                📄 Descripción *
            </label>
            <textarea name="description" 
                      id="description" 
                      rows="4"
                      placeholder="Describe los detalles de la tarea..."
                      required
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none
                             @error('description') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Campo Estado --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                🚀 Estado inicial *
            </label>
            <select name="status" 
                    id="status" 
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors
                           @error('status') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                <option value="">Selecciona el estado...</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                    📝 Pendiente
                </option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>
                    ⏳ En Progreso
                </option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                    ✅ Completada
                </option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botones de acción --}}
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <a href="/tasks" 
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-md transition-colors">
                ← Cancelar
            </a>
            
            <button type="submit" 
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                💾 Crear Tarea
            </button>
        </div>
    </form>

    {{-- Consejos útiles --}}
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <h3 class="text-sm font-medium text-blue-900 mb-2">💡 Consejos para crear buenas tareas:</h3>
        <ul class="text-sm text-blue-800 space-y-1">
            <li>• Usa títulos claros y específicos</li>
            <li>• Incluye detalles importantes en la descripción</li>
            <li>• Selecciona el estado que mejor refleje el progreso actual</li>
        </ul>
    </div>
</div>
@endsection