<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Digiriiul</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
             
            </style>
        @endif
    </head>
    <body class="bg-beige-100 dark:bg-[#0a0a0a] text-beige-950 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-4 py-2 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Digiriiul
                        </a>
                    @else
                        <nav class="flex justify-between">
                            <div class="flex gap-3">
                                <a href="/" class="flex">
                                    <x-application-logo class="w-20 h-20 fill-current" />
                                </a>
                                <a href="/" class="flex my-auto text-4xl font-bold dark:text-beige-300">
                                    Digiriiul
                                </a>
                            </div>     
                            <div class="flex items-center justify-end gap-4">
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-block px-4 py-2 
                                    bg-gray-700 dark:bg-beige-300  border border-transparent rounded-md font-semibold text-s text-white dark:text-white uppercase tracking-widest hover:bg-beige-300 dark:hover:bg-gray-600 dark:hover:border-solid dark:hover:border-beige-300 dark:hover:border-2 dark:hover:text-beige-300">
                                    Sisene
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="inline-block px-4 py-2
                                        bg-gray-700 dark:bg-beige-300  border border-transparent rounded-md font-semibold text-s text-white dark:text-white uppercase tracking-widest hover:bg-beige-300 dark:hover:bg-gray-600 dark:hover:border-solid dark:hover:border-beige-300 dark:hover:border-2 dark:hover:text-beige-300">
                                        Loo kasutaja
                                    </a>
                                @endif
                            </div>    
                        </nav>    
                    @endauth
                
            @endif
        </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <img class="w-auto h-auto" src="/images/cover_penguin_books.webp">
                
            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
