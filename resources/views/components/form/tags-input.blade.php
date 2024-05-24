
@php

  $oldValue = old($inputName) ?? ($oldValue ?? '');
  $isRequired = $isRequired ?? true;
  $inputDefaultClass =
      'block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer';

  $labelDefaultClass =
      'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6';
@endphp

<div class="relative z-0 w-full mb-5 group">
  <input type="text" name="{{ $inputName }}" id="{{ $inputName }}" class="{{ $inputDefaultClass }}"
    placeholder=" " value="{{ $oldValue }}" @if ($isRequired) required @endif />
  <label for="{{ $inputName }}" class="{{ $labelDefaultClass }}">{{ $labelName }}</label>

  @error($inputName)
    <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
  @enderror

</div>

<script>
    const inputElem = document.querySelector(
      "#{{ $inputName }}") 
      // the 'input' element which will be transformed into a Tagify component
    const tagify = new Tagify(inputElem, {
      // A list of possible tags. This setting is optional if you want to allow
      // any possible tag to be added without suggesting any to the user.
      // whitelist: ['foo', 'bar', 'and baz', 0, 1, 2]
    })

</script>
