<x-app-layout>
  <div class="pt-20"></div>

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
   
    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'email',
        'labelName' => 'email',
        'oldValue' => $listing->email,
    ])
   
    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'company',
        'labelName' => 'company',
        'oldValue' => $listing->company,
    ])
   
    @include('components.form.textarea', [
        'textareaName' => 'description',
        'labelName' => 'description',
        'oldValue' => $listing->description,
    ])

    @include('components.form.single-file-upload', [
        'inputName' => 'logo',
        'oldValue' => $listing->logo,
    ])

    <div class="flex items-center justify-center mt-4">
      <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">儲存</button>
    </div>
  </form>


</x-app-layout>
