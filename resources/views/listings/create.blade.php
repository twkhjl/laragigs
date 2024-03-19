<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('listings.store') }}">
            @csrf

            <div>
                <x-label for="title" :value="__('title')" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
                    autofocus />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="company" :value="__('company')" />
                <x-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="description" :value="__('description')" />

                <textarea required
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    name="description">{{ old('description') }} </textarea>
            </div>




            <div class="flex items-center justify-end mt-4">


                <x-button class="mx-auto">
                    {{ __('建立') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
