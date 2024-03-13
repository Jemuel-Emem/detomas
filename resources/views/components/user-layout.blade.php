<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MONTERES</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css"
    rel="stylesheet"/>

    <style>
        [x-cloak] {
            display: none;
        }
    </style>
 @wireUiScripts

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-full  bg-no-repeat bg-gradient-to-tr from-green-700 via-white to-green-100">
    @livewireScripts
    <x-notifications position="top-right" />
    <x-dialog />
    <nav class="bg-green-600 border-gray-200 dark:bg-gray-900 ">
        <div class=" flex flex-wrap items-center justify-between mx-auto p-4">
          <a href="{{ route('landingpage') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.png') }}" alt="Violation Photo" class="w-16 h-16">
            <label for="" class="font-black text-white text-2xl">MVR</label>
          </a>
          <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
          <div class="">
            <a href="{{ route('landingpage') }}" class="text-white hover:text-green-700 mr-2">Home</a>
            <a href="{{ route('cottageview') }}" class="text-white hover:text-green-700 mr-2">Map View</a>
            <a href="{{ route('cottages') }}" class="text-white hover:text-green-700 mr-2">Cottages</a>
            <a href="{{ route('about') }}" class="text-white hover:text-green-700 mr-2">About</a>
            <a href="{{ route('contactus') }}" class="text-white hover:text-green-700 mr-2">Contact Us</a>
            <a href="{{ route('rules') }}" class="text-white hover:text-green-700 mr-2">Rules</a>

          </div>


          <div class="text-white hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0  dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

              <li>
                <a href="{{ route('login') }}" class="block py-2 px-3 text-white rounded md:bg-transparent  md:p-0 dark:text-white " aria-current="page">
                LOGIN
                </a>
              </li>

            </ul>
          </div>


        </div>
      </nav>

      <div class=" ">
        <div class=" border-gray-200  rounded-lg dark:border-gray-700">

            <main class="">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>

</html>
