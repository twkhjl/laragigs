@php

  $oldValue = old($inputName) ?? ($oldValue ?? '');
  $isRequired = $isRequired ?? false;
  $inputDefaultClass = '
       border 
       border-b-1
       border-b-gray-300 
       border-t-0
       border-l-0
       border-r-0
       outline-none
       bg-transparent
       text-gray-900 
       text-md 
       focus:outline-none
       focus:ring-0 
       focus:border-b-blue-500 
       
       block w-full p-2.5 
       ';

  $labelDefaultClass = 'block mb-2 text-md font-medium text-gray-900';
@endphp

<div class="relative z-0 w-full mb-5 group">
  <label for="{{ $inputName }}" class="{{ $labelDefaultClass }}">{{ $labelName }}</label>
  <input type="{{ $inputType }}" name="{{ $inputName }}" id="{{ $inputName }}" class="{{ $inputDefaultClass }}"
    placeholder=" " value="{{ $oldValue }}" @if ($isRequired) required @endif />

  @error($inputName)
    <p class="text-red-500 text-md mb-5">{{ $message }}</p>
  @enderror

</div>
