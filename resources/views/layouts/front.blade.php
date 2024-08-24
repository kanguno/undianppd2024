<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$title ?? 'BPKPAD'}}</title>
        <link rel="icon" id="favicon" href="{{ asset('storage/image/tubankab.png') }}" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    
    <body class="font-sans antialiased">
    
    <nav class=" bg-gradient-to-tr from-[#360855] to-[#400060] p-4">
        <div class="container w-full mx-auto md:flex items-center justify-between">
            <div class="flex w-full justify-between">
                <a href="/" class="text-white text-xl font-bold flex align-middle">
                    <img class=" max-w-6 " src="{{ asset('storage/image/tubankab.png') }}" alt="">
                BPKPAD TUBAN</a>
                <button id="menu-btn" class="text-white md:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
                <div id="menu" class="hidden md:flex">
                <a href="/" class="text-white hover:cursor-pointer px-3 py-2 w-[max-content] rounded">Home</a>
                <a href="/inputdata" class="text-white hover:cursor-pointer px-3 py-2 w-[max-content] rounded">Daftar Undian</a>
            </div>
        </div>
    </nav>

    

   

        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

        @if (session('notification'))
        @php
            $notification = session('notification');
        @endphp
        <div 
            x-data="{ 
                open: true, 
                notificationType: '{{ $notification['type'] }}' 
            }"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 flex p-5 items-center justify-center z-50"
        >
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div 
                :class="{
                    'text-green-500': notificationType === 'success',
                    'text-red-500': notificationType === 'error',
                    'text-blue-500': notificationType === 'info'
                } "
                class="relative bg-white text-center font-semibold rounded-2xl shadow-lg p-4 max-w-md mx-auto"
                role="alert"
                aria-live="assertive"
            >
                <button @click="open = false" class="absolute top-2 right-2 text-gray-900" aria-label="Tutup notifikasi">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <p class="p-2 my-2 mx-5">{{ $notification['message'] }}</p>
            </div>
        </div>
    @endif
            <!-- Page Content -->
            <main class="container-fluid">
                @yield('content')
            </main>
        </div>

        @stack('modals')

        <script>
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
    </body>
    @livewireScripts
</html>
