<x-app-layout>

  <div class="pt-20"></div>

  <form class="max-w-md mx-auto" enctype="multipart/form-data" method="POST" action="{{ route('listings.store') }}">
    @csrf

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'title',
        'labelName' => '*'.trans('listings.title'),
    ])

    @include('components.form.tags-input', [
        'inputName' => 'tags',
        'labelName' => '*'.trans('listings.tags').trans('listings.tagsInstruction'),
    ])

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'email',
        'labelName' => '*'.trans('listings.email'),
    ])

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'company',
        'labelName' => '*'.trans('listings.company'),
    ])

    @include('components.form.textarea', [
        'textareaName' => 'description',
        'labelName' => "*".trans("listings.description"),
    ])

    @include('components.form.single-file-upload', [
        'inputName' => 'logo',
        'labelName' => '*'.trans('listings.logo').trans('listings.logoInstruction'),
        'accept' => '.png,.jpg,.jpeg,.gif',
    ])

    <div class="flex items-center justify-center mt-4">
      <button type="submit" onclick="initLoadingOverlay()"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">建立</button>
    </div>
  </form>

  <div class="pb-5"></div>

</x-app-layout>
