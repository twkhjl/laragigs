<x-app-layout>
  <div class="pt-20"></div>

  <form class="max-w-md mx-auto" enctype="multipart/form-data" method="POST"
    action="{{ route('listings.update', [$listing->id]) }}">
    @csrf
    @method('PUT')

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'title',
        'labelName' => '*' . trans('listings.title'),
        'oldValue' => $listing->title,
    ])

    @include('components.form.tags-input', [
        'inputName' => 'tags',
        'labelName' => '*' . trans('listings.tags') . trans('listings.tagsInstruction'),
        'oldValue' => $listing->tags,
    ])

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'location',
        'labelName' => '' . trans('listings.location'),
        'oldValue' => $listing->location,
    ])

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'email',
        'labelName' => '*' . trans('listings.email'),
        'oldValue' => $listing->email,
    ])

    @include('components.form.input', [
        'inputType' => 'text',
        'inputName' => 'company',
        'labelName' => '*' . trans('listings.company'),
        'oldValue' => $listing->company,
    ])

    @include('components.form.textarea', [
        'textareaName' => 'description',
        'labelName' => '*' . trans('listings.description'),
        'oldValue' => $listing->description,
    ])

    @include('components.form.single-file-upload', [
        'inputName' => 'logo',
        'oldValue' => $listing->logo,
        'labelName' => '' . trans('listings.logo') . trans('listings.logoInstruction'),
        'accept' => '.png,.jpg,.jpeg,.gif',
    ])

    <div class="flex items-center justify-center mt-4 gap-2">
      <button type="submit" onclick="initLoadingOverlay()"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">儲存</button>
      <button onclick="back(event)"
        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">取消</button>
      <script>
        function back(e) {
          e.preventDefault();

          location.href = "{{ route('dashboard') }}?page={{ request()->input('page') }}";
          return;

        }
      </script>
    </div>
  </form>


  <div class="pb-5"></div>


</x-app-layout>
