@php

  $oldValue = old($textareaName) ?? ($oldValue ?? '');
  $isRequired = $isRequired ?? false;
  $inputDefaultClass = '
  block 
  py-2.5 
  px-0 
  w-full 
  text-sm 
  text-gray-900
  bg-transparent 
  border 
  border-b-1
  border-b-gray-300 
  border-t-0
  border-l-0
  border-r-0
  outline-none
  appearance-none 
  focus:outline-none 
  focus:ring-0 
  focus:border-blue-500 
  peer';

  $labelDefaultClass = 'block mb-2 text-sm font-medium text-gray-900';
@endphp

<div class="relative z-0 w-full mb-5 group">
  <label for="{{ $textareaName }}" class="{{ $labelDefaultClass }}">{{ $labelName }}</label>
  <textarea name="{{ $textareaName }}" id="{{ $textareaName }}" class="{{ $inputDefaultClass }}" placeholder=" "
    @if ($isRequired) required @endif>{{ $oldValue }}</textarea>

  @error($textareaName)
    <p class="text-red-500 text-md mb-5">{{ $message }}</p>
  @enderror

</div>
