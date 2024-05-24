<div class="pt-10"></div>

<div class="flex">

  <button type="button" onclick="location.href='/listings/create'"
    class="ml-0 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300  rounded-md text-sm px-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">新增</button>

  <form action="/dashboard">
    <div class="relative text-gray-600 mb-2">
      <input type="search" name="search" placeholder="搜尋"
        @if (request('search')) value="{{ request('search') }}" @endif
        class="bg-white h-10 px-5 pr-10 rounded-md text-sm focus:outline-none">
      <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966"
          style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
          <path
            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
        </svg>
      </button>
    </div>
  </form>

</div>



<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
      <th scope="col" class="px-6 py-3 text-center">
        職缺名稱
      </th>
      <th scope="col" class="px-6 py-3 text-center">
        公司名稱
      </th>
      <th scope="col" class="px-6 py-3 text-center">
        縮圖
      </th>
      <th scope="col" class="px-6 py-3 text-center">
        分類標籤
      </th>
      <th scope="col" class="px-6 py-3 text-center">
        動作
      </th>
    </tr>
  </thead>
  <tbody>

    @foreach ($listings as $key => $value)
      <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <td class="px-6 py-4 text-center">
          {{ $value->title }}
        </td>
        <td class="px-6 py-4 text-center">
          {{ $value->company }}
        </td>
        <td class="px-6 py-4 flex justify-center">

          <button data-modal-target="select-modal{{ $value->id }}"
            data-modal-toggle="select-modal{{ $value->id }}" type="button">
            <img src="{{ $value->logo }}" class="w-8" alt="" srcset="">
          </button>

          @include('components.modals.modal-preview-img', [
              'modalID' => "select-modal{$value->id}",
              'imgUrl' => $value->logo,
          ])

        </td>
        <td class="px-6 py-4 text-center">
          @include('components.tags-show', [
              'tags' => $value->tags,
          ])
        </td>
        <td class="px-6 py-4 text-center">
          <div class="flex gap-4 align-middle justify-center">
            <a href="/listings/{{ $value->id }}/edit?page={{ $page }}"
              class="block focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"><i
                class="fa-solid fa-pen"></i></a>

            <form method="POST" id="form{{ $value->id }}" action="/listings/{{ $value->id }}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}

              @php
                $modalID = "deleteModal{$value->id}";
                $confirmTriggerFn = "triggerDelBtn{$value->id}";
              @endphp

              <button data-modal-target="{{ $modalID }}" data-modal-toggle="{{ $modalID }}"
                onclick="onDelBtnClick(event)"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><i
                  class="fa-solid fa-trash"></i></button>

              <button class="hidden" type="submit" id="delBtn{{ $value->id }}">實際刪除鈕</button>
              <script>
                function onDelBtnClick(e) {
                  return e.preventDefault();
                }

                function triggerDelBtn{{ $value->id }}() {
                  document.querySelector("#form{{ $value->id }}").submit();
                }
              </script>
            </form>

            @include('components.modals.modal-confirm-del', [
                'modalID' => $modalID,
                'confirmTriggerFn' => $confirmTriggerFn,
                'confirmDelMessage' => '是否確定刪除?',
                'btnConfirmText' => '確定',
                'btnCancelText' => '取消',
            ])

          </div>
        </td>
      </tr>
    @endforeach

  </tbody>
</table>
@if (count($listings) <= 0)
  <div class="text-center mt-6">查無資料</div>
@endif

<div class="mt-4">
  {{ $listings->links('vendor.pagination.tailwind') }}
</div>
