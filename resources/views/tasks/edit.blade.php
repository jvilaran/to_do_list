@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Task</h1>
        
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            There were some errors with your submission:
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="/tasks/{{ $task->id }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $task->title) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-300 @enderror"
                    placeholder="Enter task title"
                    required
                >
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 @enderror"
                    placeholder="Enter task description"
                    required
                >{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select 
                    id="status" 
                    name="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-300 @enderror"
                    required
                >
                    <option value="">Select status</option>
                    <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>
                        In Progress
                    </option>
                    <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <a href="/" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Back to Tasks
                </a>
                
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm bg-blue-600 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fa-solid fa-save mr-2"></i>
                    Update Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection