@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="max-w-4xl mx-auto p-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 pb-6 border-b border-gray-200">
        <div class="flex-1">
            <div class="flex items-center mb-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mr-3
                    @if($task->status === 'completed') bg-green-100 text-green-800
                    @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                    @else bg-gray-800 text-white
                    @endif">
                    @if($task->status === 'completed') <i class="fa-solid fa-check"></i> Completed
                    @elseif($task->status === 'in_progress') <i class="fa-solid fa-hourglass-half"></i> In Progress
                    @else <i class="fa-solid fa-spinner"></i> Pending
                    @endif
                </span>
            </div>
            
            <h1 class="text-3xl font-bold text-white mb-2">{{ $task->title }}</h1>
            
            <div class="flex items-center text-sm text-gray-400 space-x-4">
                <span class="flex items-center">
                    <i class="fa-solid fa-calendar"></i> Created: {{ $task->created_at->format('d/m/Y H:i') }}
                </span>
                @if($task->updated_at->ne($task->created_at))
                    <span class="flex items-center">
                        <i class="fa-solid fa-sync"></i> Updated: {{ $task->updated_at->format('d/m/Y H:i') }}
                    </span>
                @endif
            </div>
        </div>

        {{-- Action buttons --}}
        <div class="flex items-center space-x-3 mt-4 sm:mt-0">
            <a href="/tasks/edit/{{ $task->id }}" 
               class="inline-flex items-center px-4 py-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-700 font-medium rounded-lg border border-yellow-200 transition-colors">
                <i class="fa-solid fa-pencil-alt"></i> Edit
            </a>
            
            <button onclick="confirmDelete({{ $task->id }})"
                    class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-medium rounded-lg border border-red-200 transition-colors">
                <i class="fa-solid fa-trash"></i> Delete
            </button>
            
            <a href="/" 
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-300 transition-colors">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    {{-- Main content --}}
    <div class="grid gap-8 lg:grid-cols-3">
        {{-- Main description --}}
        <div class="lg:col-span-2">
            <div class="bg-gray-900 rounded-lg border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-white flex items-center">
                        <i class="fa-solid fa-file-alt"></i> Description
                    </h2>
                </div>
                <div class="px-6 py-4">
                    <p class="text-gray-400 leading-relaxed whitespace-pre-wrap">{{ $task->description }}</p>
                </div>
            </div>

            {{-- Change log --}}
            <div class="mt-6 bg-gray-900 rounded-lg border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-white flex items-center">
                        <i class="fa-solid fa-chart-line"></i> Logs
                    </h2>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                <span class="text-indigo-600 text-sm"><i class="fa-solid fa-check"></i></span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-white">
                                <span class="font-medium">Created task</span>
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
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
                                <p class="text-sm text-gray-400">
                                    <span class="font-medium">Task updated</span>
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $task->updated_at->format('d/m/Y \a \l\a\s H:i') }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar with information --}}
        <div class="space-y-6">
            {{-- Task information --}}
            <div class="bg-gray-900 rounded-lg border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-white"><i class="fa-solid fa-info-circle"></i> Information</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-400">ID</dt>
                        <dd class="mt-1 text-sm text-white font-mono">#{{ $task->id }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($task->status === 'completed') bg-green-100 text-green-800
                                @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                @else bg-gray-800 text-white
                                @endif">
                                @if($task->status === 'completed') <i class="fa-solid fa-check"></i> Completed
                                @elseif($task->status === 'in_progress') <i class="fa-solid fa-hourglass-half"></i> In Progress
                                @else <i class="fa-solid fa-spinner"></i> Pending
                                @endif
                            </span>
                        </dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Created date</dt>
                        <dd class="mt-1 text-sm text-white">{{ $task->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Last updated</dt>
                        <dd class="mt-1 text-sm text-white">{{ $task->updated_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection