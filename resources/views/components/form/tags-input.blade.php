@php

  $oldValue = old($inputName) ?? ($oldValue ?? '');
  $isRequired = $isRequired ?? false;
  $inputDefaultClass = '';

  $labelDefaultClass = '';
@endphp

<div class="relative z-0 w-full mb-5 group">
  <label for="{{ $inputName }}" class="block mb-2 text-sm font-medium focus:text-blue-900 text-gray-900">{{ $labelName }}</label>
  <input type="text" name="{{ $inputName }}" id="{{ $inputName }}" 
  class="
  border-b-20 border-t-0 border-l-0 border-r-0
  
    text-gray-900 text-sm 
  block w-full p-1" placeholder="輸入後按enter" />

  @error($inputName)
    <p class="text-red-500 text-md mb-5">{{ $message }}</p>
  @enderror
</div>

<script>
  const inputElem = document.querySelector("#{{ $inputName }}");

  const tagify = new Tagify(inputElem, {});

</script>
