<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard SM-Kompensasi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-slate-50 flex flex-col h-screen overflow-hidden text-sm">    
    
    @includeIf('layouts.header')

    <div class="flex flex-1 overflow-hidden relative">
        
        @includeIf('layouts.sidebar')

        <main class="flex-1 overflow-y-auto bg-slate-50">
            <div class="p-6">
                <section class="mb-6">
                    <h1 class="text-xl font-bold text-gray-800">@yield('title')</h1>
                    <nav class="text-xs text-gray-500 mt-1">
                        <ol class="flex gap-2">
                            @section('breadcrumb')
                                <li><a href="{{ url('/') }}" class="hover:text-blue-500"><i class="fa fa-dashboard"></i> Home</a></li>
                            @show
                        </ol>
                    </nav>
                </section>

                <section class="content">
                    @yield('content')
                </section>
            </div>
        </main>
    </div>
</body>
</html>