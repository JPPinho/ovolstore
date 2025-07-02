<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-g">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ovol Assignment</title>

    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">

<div class="relative min-h-screen flex flex-col items-center justify-center">
    <div class="text-center">

        <!-- The Header -->
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-8">
            Ovol Assignment
        </h1>

        <!-- The Button -->
        <a href="/admin/products"
           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out">
            Go to Admin Products
        </a>

    </div>
</div>

</body>
</html>

