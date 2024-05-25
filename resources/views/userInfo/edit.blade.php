<x-app-layout>
  <div class="pt-20"></div>

  <form class="px-4 md:px-8 max-w-3xl mx-auto py-12" enctype="multipart/form-data" method="POST"
    action="{{ route('userInfo.update', [$user->id]) }}">
    @csrf
    @method('PUT')

    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">個人設定頁面</h2>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

          <div class="sm:col-span-4">
            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">帳號</label>
            <div class="mt-2">
              <span class="flex select-none items-center text-gray-500 sm:text-sm">{{ $user->email }}</span>
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">名稱</label>
            <div class="mt-2">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" name="name" id="name" autocomplete="name"
                  value="{{ old('name') ?? $user->name ?? '' }}"
                  class="block flex-1 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                  placeholder="請輸入名稱">
              </div>
            </div>
          </div>

          <div class="col-span-full">
            <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">頭像</label>
            <div class="mt-2 flex items-center gap-x-3">
              <div class="h-24 w-24 text-gray-300">
                <img id='preview_img' class="object-cover" src="{{ $user->icon ?? asset('images/user-icon.png') }}" alt="" />
              </div>

              <button type="button" onclick="selectFile()"
                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">修改</button>
              <input name="icon" type="file" onchange="previewImg(event)" accept="" class="hidden">


            </div>

          </div>
          @error('icon')
            <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
          @enderror

          <script>
            function selectFile() {
              document.querySelector("input[name='icon']").click();
            }
            const previewImg = function(event) {

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
      </div>

      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">密碼設定</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">若有需要更改再填寫</p>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

          <div class="sm:col-span-2 sm:col-start-1">
            <label for="old_password" class="block text-sm font-medium leading-6 text-gray-900">舊密碼</label>
            <div class="mt-2">
              <input type="password" name="old_password" id="old_password" autocomplete="address-level2"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              @error('old_password')
                <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
              @enderror

            </div>
          </div>
          <div class="sm:col-span-2">
            <label for="new_password" class="block text-sm font-medium leading-6 text-gray-900">新密碼</label>
            <div class="mt-2">
              <input type="password" name="new_password" id="new_password" autocomplete="address-level1"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              @error('new_password')
                <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="sm:col-span-2">
            <label for="new_password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">確認密碼</label>
            <div class="mt-2">
              <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                autocomplete="new_password_confirmation"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              @error('new_password_confirmation')
                <p class="text-red-500 text-xs mb-5">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
      </div>


    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">取消</button>
      <button type="submit"
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">儲存</button>
    </div>
  </form>

  <div class="pb-5"></div>


</x-app-layout>
