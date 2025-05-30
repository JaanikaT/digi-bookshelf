<x-guest-layout>
    <div class="mb-4 text- text-gray-600 dark:text-gray-400">
        {{ __('Unustasid parooli?')}} <br><br> {{('Sisesta e-mail ja saadame lingi parooli taastamiseks.')  }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button>
                {{ __('Saada link parooli taastamiseks') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
