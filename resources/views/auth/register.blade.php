<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="flex flex-col">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nimi')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Parool')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Pikkus vähemalt 8 tähemärki" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Kinnita parool')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex">
            <x-primary-button class="items-center justify-center my-4">
                <span>{{ __('Loo konto') }}</span>
            </x-primary-button>
        </div>
        <div>
            <div class="flex my-2">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-[#d8bc97] dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d8bc97] dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Konto olemas? Logi sisse') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
