<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Parool')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-[#d8bc97] dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Jäta mind meelde') }}</span>
            </label>
        </div>
        <div class="flex items-center justify-center my-6 w-auto">
            <x-primary-button class="flex hover:bg-[#d8bc97] justify-center"><span>
                {{ __('Sisene') }}</span>
            </x-primary-button>
        </div>
        <div class="flex flex-col my-2 gap-2">
            <div class="flex">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-[#d8bc97] dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d8bc97] dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Unustasid parooli?') }}
                    </a>
                @endif
            </div>
            <div class="flex">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-[#d8bc97] dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d8bc97] dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                    {{ __('Pole kasutajat? Loo konto') }}
                </a>
            </div>
        </div>        
    </form>
</x-guest-layout>
