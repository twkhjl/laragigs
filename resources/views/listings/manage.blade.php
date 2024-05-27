<div class="pt-10"></div>

<div class="relative overflow-x-auto sm:rounded-lg">
  <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">


    {{-- 批次操作下拉選單 --}}

    <div id="dropdownActionContainer" class="hidden">
      <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
        type="button">
        <span class="sr-only">Action button</span>
        批次操作
        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 4 4 4-4" />
        </svg>
      </button>
      <!-- 批次操作 -->
      <div id="dropdownAction"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">

          <li>
            <a onclick="clearAll()"
              class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
              清除已選取項目</a>
          </li>

          <li>
            <form id="formDestroyAll" method="POST" action="{{ route('listings.destroyAll') }}">
              @csrf
              <a data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">刪除選取項目</a>

              <div class="hidden">
                <input type="text" id="inputItemIDs" name="inputItemIDs">
              </div>
            </form>
          </li>
        </ul>
      </div>

      @include('components.modals.modal-confirm-del', [
          'modalID' => 'popup-modal',
          'confirmTriggerFn' => 'triggerDestroyAllBtn',
          'confirmDelMessage' => '刪除選取資料?',
          'btnConfirmText' => '確定',
          'btnCancelText' => '取消',
      ])

    </div>

    {{-- 新增 --}}

    <button type="button" onclick="location.href='/listings/create'"
      class="ml-2 mr-auto text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">新增</button>

    {{-- <button type="button" onclick="location.href='/listings/create'"
      class="ml-2 mr-auto focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">新增</button> --}}

    {{-- 搜尋 --}}
    @include('listings.manage-search')


  </div>
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="p-4">
          <div class="flex items-center">
            <input id="checkbox-select-all" type="checkbox"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-select-all" class="sr-only">checkbox</label>
          </div>
        </th>
        <th scope="col" class="px-6 py-3 text-center">
          @sortablelink('location', trans('listings.title'))
        </th>
        <th scope="col" class="px-6 py-3 text-center">
          {{ trans('listings.company') }}
        </th>
        <th scope="col" class="px-6 py-3 text-center">
          {{ trans('listings.logo') }}
        </th>
        <th scope="col" class="px-6 py-3 text-center">
          {{ trans('listings.tags') }}
        </th>
        <th scope="col" class="px-6 py-3 text-center">
          {{ trans('listings.location') }}
        </th>
        <th scope="col" class="px-6 py-3 text-center">
          @sortablelink('updated_at', '更新時間')
        </th>

        <th scope="col" class="px-6 py-3 text-center">
          操作
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($listings as $key => $value)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <td class="w-4 p-4">
            <div class="flex items-center">
              <input id="checkbox-table-{{ $value->id }}" type="checkbox" value="{{ $value->id }}"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              <label for="checkbox-table-{{ $value->id }}" class="sr-only">checkbox</label>
            </div>
          </td>
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
            {{ $value->location }}
          </td>

          <td class="px-6 py-4 text-center">
            {{ \Carbon\Carbon::parse($value->updated_at)->format('Y-m-d H:i') }}
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
                    initLoadingOverlay();
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
</div>


{{-- 批次操作下拉選單 --}}
<script>
  const checkboxSelectAll = document.querySelector('#checkbox-select-all');
  const inputItemIDs = document.querySelector('#inputItemIDs');
  const checkboxes = document.querySelectorAll("input[id*='checkbox-table']");


  // 儲存要批次操作的項目id
  let checkedIdArr = [];

  // 將checkbox加上事件
  checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', function(event) {

      if (event.target.checked) {
        checkedIdArr.push(event.target.value);
      }
      if (!event.target.checked) {
        checkedIdArr = checkedIdArr.filter(e => e != event.target.value);
      }

      if (checkedIdArr.length > 0) {
        showDropdownAction();
      }
      if (checkedIdArr.length <= 0) {
        hideDropdownAction();
      }
      
    });
  });

  // 全選checkbox觸發事件
  checkboxSelectAll.addEventListener('click', function(event) {

    // 取消勾選
    if (!event.target.checked) {
      clearAll();
      hideDropdownAction();
      return;
    }

    // 若勾選則全選其餘項目
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = true;
    });

    // 將有勾選的checkbox的值存入變數中
    const checkedCheckboxes = document.querySelectorAll("input[id*='checkbox-table']:checked");
    checkedCheckboxes.forEach(function(checkbox) {
      checkedIdArr.push(checkbox.value);
    });

    checkedIdArr = Array.from(new Set(checkedIdArr));

    if (checkedIdArr.length > 0) {
      showDropdownAction();
    }

  });

  // 清除已選取
  function clearAll() {
    checkboxSelectAll.checked = false;
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = false;
    });
    checkedIdArr = [];

    document.querySelector("body").click();
    hideDropdownAction();
    return;
  }

  // 隱藏刪除選取項目的選項
  function hideDropdownAction() {
    document.querySelector('#dropdownActionContainer').classList.add('hidden');
  }

  // 顯示刪除選取項目的選項
  function showDropdownAction() {
    document.querySelector('#dropdownActionContainer').classList.remove('hidden');
  }

  // 刪除選取項目
  function triggerDestroyAllBtn() {

    // 將要刪除的項目id存在input欄位,用於表單提交
    inputItemIDs.value = checkedIdArr.join(',');
    
    initLoadingOverlay();
    
    document.querySelector("#formDestroyAll").submit();
  }
</script>
