<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('create') }}
    </h2>
  </x-slot>


  <form class="max-w-md mx-auto" enctype="multipart/form-data" method="POST" action="{{ route('listings.store') }}">
    @csrf

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'title',
        'labelName' => 'title',
    ])
    @error('title')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror
    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'email',
        'labelName' => 'email',
    ])
    @error('email')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror
    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'company',
        'labelName' => 'company',
    ])
    @error('company')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror
    @include('components.form.textarea', [
        'textareaName' => 'description',
        'labelName' => 'description',

    ])
    @error('description')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror


    @include('components.form.single-file-upload', [
        'inputName' => 'logo',
    ])
    @error('logo')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror





    <div class="flex items-center justify-center mt-4">
      <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">建立</button>
    </div>
  </form>


  {{-- <x-auth-card>
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
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
      </div>

      <div class="mt-4">
        <x-label for="company" :value="__('company')" />
        <x-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required />
      </div>

      <div class="mt-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
        <input
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          id="file_input" type="file">

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
  </x-auth-card> --}}
</x-app-layout>
