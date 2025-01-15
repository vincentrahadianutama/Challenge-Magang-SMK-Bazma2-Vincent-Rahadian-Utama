<header class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-blue-600">
            Book<span class="text-gray-700">Manager</span>
        </a>

        <!-- Navigation Links -->
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 {{ request()->routeIs('dashboard') ? 'font-bold text-blue-600' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('book_categories.index') }}" class="text-gray-600 hover:text-blue-600 {{ request()->routeIs('book_categories.*') ? 'font-bold text-blue-600' : '' }}">
                Categories
            </a>
            <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-blue-600 {{ request()->routeIs('books.*') ? 'font-bold text-blue-600' : '' }}">
                Books
            </a>
            <a href="{{ route('kirim-email') }}" class="text-gray-600 hover:text-blue-600 {{ request()->routeIs('send-email') ? 'font-bold text-blue-600' : '' }}">
                Contact
            </a>
        </nav>

        <!-- User Dropdown -->
        <div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
        <div>{{ Auth::user()->name }}</div>
        <div class="ml-1">
            <svg class="fill-current h-4 w-4 transform transition-transform duration-200" :class="open ? 'rotate-180' : 'rotate-0'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
    </button>
    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
        <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</button>
        </form>
    </div>
</div>


        <!-- Hamburger Menu -->
        <button class="md:hidden text-gray-600 focus:outline-none" @click="open = !open">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden" :class="{ 'block': open, 'hidden': !open }">
        <nav class="space-y-2 px-4 py-3 bg-white shadow-md">
            <a href="{{ route('dashboard') }}" class="block text-gray-600 hover:text-blue-600 {{ request()->routeIs('dashboard') ? 'font-bold text-blue-600' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('book_categories.index') }}" class="block text-gray-600 hover:text-blue-600 {{ request()->routeIs('book_categories.*') ? 'font-bold text-blue-600' : '' }}">
                Categories
            </a>
            <a href="{{ route('books.index') }}" class="block text-gray-600 hover:text-blue-600 {{ request()->routeIs('books.*') ? 'font-bold text-blue-600' : '' }}">
                Books
            </a>
            <a href="{{ route('kirim-email') }}" class="block text-gray-600 hover:text-blue-600 {{ request()->routeIs('send-email') ? 'font-bold text-blue-600' : '' }}">
                Contact
            </a>
            <div class="border-t border-gray-200 pt-2">
                <a href="{{ route('profile.edit') }}" class="block text-gray-600 hover:text-blue-600">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block text-gray-600 hover:text-blue-600 w-full text-left">Log Out</button>
                </form>
            </div>
        </nav>
    </div>
</header>
