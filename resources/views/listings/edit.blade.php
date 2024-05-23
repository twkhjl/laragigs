<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('create') }}
    </h2>
  </x-slot>


  <form class="max-w-md mx-auto" enctype="multipart/form-data" method="POST"
    action="{{ route('listings.update', [$listing->id]) }}">
    @csrf
    @method('PUT')

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'title',
        'labelName' => 'title',
        'oldValue' => $listing->title,
    ])
    @error('title')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror
    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'email',
        'labelName' => 'email',
        'oldValue' => $listing->email,
    ])
    @error('email')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror
    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'company',
        'labelName' => 'company',
        'oldValue' => $listing->company,
    ])
    @error('company')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror
    @include('components.form.textarea', [
        'textareaName' => 'description',
        'labelName' => 'description',
        'oldValue' => $listing->description,
    ])
    @error('description')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror


    @include('components.form.single-file-upload', [
        'inputName' => 'logo',
        'oldValue' => $listing->logo,
    ])
    @error('logo')
      <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
    @enderror





    <div class="flex items-center justify-center mt-4">
      <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">儲存</button>
    </div>
  </form>


</x-app-layout>
