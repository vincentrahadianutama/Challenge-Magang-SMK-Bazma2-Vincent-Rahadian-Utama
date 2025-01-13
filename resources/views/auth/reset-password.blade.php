<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Reset your password by providing your email address, the reset token, and your new password.') }}
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password-new.update') }}">

        @csrf
        @method('PUT')

        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mt-4">
            <label for="token" class="block font-medium text-sm text-gray-700">{{ __('Token') }}</label>
            <input id="token" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="token" value="{{ request('token') }}" required>
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Reset Password') }}</x-primary-button>
        </div>
        
    </form>
    
</x-guest-layout>
