<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="min-h-screen flex flex-col items-center justify-center bg-gray-300">
        <div class="text-center p-6 bg-white rounded-lg shadow-2xl">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Welcome to {{ config('app.name', 'Product Microservice') }}</h1>
            <p class="text-gray-700 mb-6">This microservice manages all products for your application.</p>
            <div class="mt-10 text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Product Microservice') }}. All rights reserved.
            </div>
        </div>
    </body>
</html>
