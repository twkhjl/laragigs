@php
$oldValue = $oldValue ?? '';
$srcImg = $oldValue ? $oldValue : '';
// $srcImg = $oldValue ? asset('storage/' . $oldValue) : '';
@endphp

<div class="relative z-0 w-full mb-5 group">

  <label class="block">
    <input name="{{ $inputName }}" type="file" onchange="loadFile(event)"
      class="block w-full text-sm text-gray-500
  file:me-4 file:py-2 file:px-4
  file:rounded-lg file:border-1
  file:text-sm file:font-semibold
  file:bg-grey-600
  hover:file:bg-grey-700
  file:disabled:opacity-50 file:disabled:pointer-events-none
">
  </label>
  <div class="shrink-0">
    <img id='preview_img' class="mt-2 object-cover" 
    src="{{$srcImg}}"
    alt="" />
  </div>
  <script>
    const loadFile = function(event) {

      const input = event.target;
      const file = input.files[0];
      const type = file.type;

      const output = document.getElementById('preview_img');


      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
  </script>
</div>
