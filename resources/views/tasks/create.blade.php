@extends('layouts.app')

@section('title', 'Crear Nueva Tarea')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-white">Create new task</h1>
            <p class="text-gray-400 mt-2">Fill in the fields to add a new task to your list</p>
        </div>

        {{-- Form --}}
        <form action="/tasks/store" method="POST" class="space-y-6">
            @csrf

            {{-- Field Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-white mb-2">
                    Task Title *
                </label>
                <input type="text" name="title" id="title" placeholder="E.g. Complete Laravel project"
                    value="{{ old('title') }}" required
                    class="placeholder-gray-400 text-white w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors
                          @error('title') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-white mb-2">
                    Task Description *
                </label>
                <textarea name="description" id="description" rows="4" placeholder="Describe los detalles de la tarea..." required
                    class="placeholder-gray-400 text-white w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none
                             @error('description') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field Status --}}
            <div>
                <label for="status" class="block text-sm font-medium text-white mb-2">
                    Task Status *
                </label>
                <select name="status" id="status" required
                    class="text-white bg-gray-800 w-full px-3 py-2 border border-indigo-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors
                           @error('status') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                    <option value="">Select status...</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>
                        In Progress
                    </option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action buttons --}}
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="/tasks"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-md transition-colors">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Create Task
                </button>
            </div>
        </form>

        {{-- Tips --}}
        <div class="mt-8 bg-gray-900 border border-gray-200 rounded-lg p-4">
            <h3 class="text-sm font-medium text-white mb-2"><i class="fa-solid fa-lightbulb"></i> Tips for creating good
                tasks:</h3>
            <ul class="text-sm text-gray-400 space-y-1">
                <li>• Use clear and specific titles</li>
                <li>• Include important details in the description</li>
                <li>• Select the status that best reflects the current progress</li>
            </ul>
        </div>
    </div>
@endsection
