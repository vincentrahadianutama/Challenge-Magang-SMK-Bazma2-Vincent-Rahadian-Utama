<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Book<span class="text-gray-700">Manager</span></h1>
            <nav>
                <ul class="flex space-x-6 text-gray-600">
                    <li><a href="#features" class="hover:text-blue-600">Features</a></li>
                    <li><a href="#about" class="hover:text-blue-600">About</a></li>
                    <li><x-nav-link :href="route('kirim-email')" :active="request()->routeIs('send-email')">
                        {{ __('Contact') }}
                    </x-nav-link></li>
                    <li>
                        <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-blue-50">
        <div class="container mx-auto px-6 py-20 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Manage Your Books, Your Way</h2>
            <p class="text-lg text-gray-600 mb-6">Easily organize, track, and share your personal or professional library with our user-friendly Book Management application.</p>
            <a href="/register" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800">Features</h3>
                <p class="text-gray-600">Everything you need to manage your books efficiently.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow">
                    <h4 class="text-xl font-semibold text-blue-600 mb-2">Organize</h4>
                    <p class="text-gray-600">Create categories and tags to organize your book collection.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow">
                    <h4 class="text-xl font-semibold text-blue-600 mb-2">Track</h4>
                    <p class="text-gray-600">Keep track of borrowed books and due dates.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow">
                    <h4 class="text-xl font-semibold text-blue-600 mb-2">Share</h4>
                    <p class="text-gray-600">Share your book collection with friends and colleagues.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-gray-800 mb-4">About Us</h3>
            <p class="text-gray-600">We are passionate about helping you manage your books effortlessly. Our mission is to provide a modern, reliable, and intuitive platform for book enthusiasts, librarians, and professionals.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2025 BookManager. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
