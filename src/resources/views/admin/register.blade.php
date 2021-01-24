<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <x-jet-authentication-card-logo />
                </div>
                <div class="ml-2">
                    <div class="text-xl font-medium text-black">{{ config('app.name', 'Laravel') }} initialization</div>
                    <p class="text-gray-500">Administrator registration</p>
                </div>
            </div>
        </x-slot>

{{--        <x-jet-validation-errors class="mb-4" />--}}

        <form method="POST" action="{{ route('init_application') }}">
            @csrf

            <input type="hidden" name="checksum" value="{{ $checksum }}">

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>