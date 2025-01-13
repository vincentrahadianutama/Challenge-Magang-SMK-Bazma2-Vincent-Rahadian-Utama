<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Welcome Back!</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter your email"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Enter your password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" name="remember">
                        <span class="ms-2">Remember Me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-700">Forgot Password?</a>
                    @endif
                </div>

                <!-- Login Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center bg-purple-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Log in
                    </button>
                </div>
            </form>

            <!-- Register Button -->
            <div class="mt-6">
                <p class="text-sm text-gray-600 text-center">Don't have an account?</p>
                <a 
                    href="{{ route('register') }}" 
                    class="w-full mt-3 flex justify-center items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Register
                </a>
            </div>

            <div class="mt-6 flex items-center justify-center">
                <span class="block w-full border-t border-gray-300"></span>
                <span class="px-4 text-sm text-gray-500 bg-white">OR</span>
                <span class="block w-full border-t border-gray-300"></span>
            </div>

            <!-- Google Login -->
            <div class="mt-6">
                <a 
                    href="{{ route('auth.google') }}" 
                    class="w-full flex justify-center items-center bg-red-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                        <path d="M44.5 20H24v8.5h11.8C33.4 34.3 29.4 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.3 0 6.4 1.3 8.7 3.5L39.1 7.5C35 3.8 29.8 1.5 24 1.5 11.5 1.5 1.5 11.5 1.5 24S11.5 46.5 24 46.5C34.9 46.5 44 37.5 44 27.5c0-1.8-.2-3.5-.5-5.5z"></path>
                    </svg>
                    Login with Google
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
