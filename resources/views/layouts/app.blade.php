<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'To-Do List') - My App</title>

    <script src="https://kit.fontawesome.com/23885ac5b5.js" crossorigin="anonymous"></script>
    
    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!--- BODY START -->
<body class="h-full bg-gray-900">
    {{-- NAVBAR --}}
    <nav class="bg-gray-900 shadow-sm border-b border-indigo-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Img/Title --}}
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-white">
                        <a href="/tasks" class="hover:text-indigo-600 transition-colors"><i class="fa-solid fa-list-check"></i> To-Do List</a>
                    </h1>
                </div>
                
                {{-- Nav routing --}}
                <div class="flex items-center space-x-4">
                    <a href="/tasks" 
                       class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors 
                              {{ request()->is('tasks') && !request()->is('tasks/create') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                        <i class="fa-solid fa-list-ul"></i> My Tasks
                    </a>
                    <a href="/tasks/create" 
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors shadow-sm">
                        <i class="fa-solid fa-plus"></i> New Task
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <span class="text-green-600 mr-2"><i class="fa-solid fa-check"></i></span>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <span class="text-red-600 mr-2"><i class="fa-solid fa-xmark"></i></span>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <span class="text-red-600 mr-2 mt-0.5"><i class="fa-solid fa-exclamation-triangle"></i></span>
                    <div>
                        <p class="font-medium mb-1">Please correct the following errors:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Specific content for each page --}}
        <div class="bg-gray-900">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 border-t border-indigo-500 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} My To-Do List App. Created with <i class="fa-solid fa-heart"></i> and Laravel + Tailwind CSS
            </p>
        </div>
    </footer>
</body>
</html>