
<div class="pt-10"></div>

<button type="button" onclick="location.href='/listings/create'"
  class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-md px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">新增</button>

<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
      <th scope="col" class="px-6 py-3">
        職缺名稱
      </th>
      <th scope="col" class="px-6 py-3">
        公司名稱
      </th>
      <th scope="col" class="px-6 py-3">
        email
      </th>
      <th scope="col" class="px-6 py-3">
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
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ $value['title'] }}
        </th>
        <td class="px-6 py-4">
          {{ $value['company'] }}
        </td>
        <td class="px-6 py-4">
          {{ $value['email'] }}
        </td>
        <td class="px-6 py-4">
          @include('components.tags-show',[
            "tags"=>$value['tags']
          ])
        </td>
        <td class="px-6 py-4">
          <div class="flex gap-4 align-middle justify-center">
            <a href="/listings/{{ $value->id }}/edit?page={{$page}}"
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
                function onDelBtnClick(e){
                  return e.preventDefault();
                }
                function triggerDelBtn{{ $value->id }}() {
                  document.querySelector("#form{{ $value->id }}").submit();
                }
              </script>
            </form>

            @include('components.modal-confirm-del', [
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

<div class="mt-4">
  {{ $listings->links('vendor.pagination.tailwind') }}
</div>
