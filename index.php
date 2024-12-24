<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white py-8 md:py-12 shadow-lg">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-center tracking-wide">
            Welcome to Financial Planner
        </h1>
    </header>

    <!-- Navigation -->
    <nav class="flex justify-center items-center space-x-4 mt-8 px-6">
        <!-- Emergency Fund Link -->
        <a href="dana_darurat.php" class="flex items-center px-3 py-2 bg-purple-700 text-white rounded-lg shadow-md transform hover:scale-105 hover:bg-purple-800 transition-all duration-300 ease-in-out">
            <i class="fas fa-exclamation-triangle text-xl mr-2 transform transition-transform duration-300 hover:rotate-180"></i>
            <span class="text-sm sm:text-base font-semibold">Emergency Fund</span>
        </a>

        <!-- Dream Car Link -->
        <a href="beli_kendaraan.php" class="flex items-center px-3 py-2 bg-green-600 text-white rounded-lg shadow-md transform hover:scale-105 hover:bg-green-700 transition-all duration-300 ease-in-out">
            <i class="fas fa-car text-xl mr-2 transform transition-transform duration-300 hover:rotate-180"></i>
            <span class="text-sm sm:text-base font-semibold">Dream Car</span>
        </a>

        <!-- Investment Calculator Link -->
        <a href="calculator.php" class="flex items-center px-3 py-2 bg-yellow-600 text-white rounded-lg shadow-md transform hover:scale-105 hover:bg-yellow-700 transition-all duration-300 ease-in-out">
            <i class="fas fa-calculator text-xl mr-2 transform transition-transform duration-300 hover:rotate-180"></i>
            <span class="text-sm sm:text-base font-semibold">Investment Calculator</span>
        </a>
    </nav>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto mt-16 bg-white p-6 md:p-8 lg:p-12 rounded-xl shadow-2xl">
        <p class="text-gray-700 text-base sm:text-lg md:text-xl text-center leading-relaxed">
            Select one of the navigation options above to continue. Each section is designed to help you plan your financial future efficiently.
        </p>
    </main>

</body>
</html>
