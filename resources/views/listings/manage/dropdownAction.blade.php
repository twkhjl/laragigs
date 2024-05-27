{{-- 批次操作下拉選單 --}}
<div>
  <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
    type="button">
    <span class="sr-only">Action button</span>
    批次操作
    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
  </button>
  <!-- 批次操作 -->
  <div id="dropdownAction"
    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">

      <li>
        <a id="actionLinkClearAll"
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
</div>

<script>
  function documentReady(callback) {
    if (document.readyState === "loading") {
      // Check if DOM is still loading
      document.addEventListener("DOMContentLoaded", callback); // Wait for DOMContentLoaded event
    } else {
      // DOMContentLoaded has already fired
      callback(); // Execute the callback immediately
    }
  }

  documentReady(function() {

    // 批次操作
    const checkboxSelectAll = document.querySelector('#checkbox-select-all');
    const inputItemIDs = document.querySelector('#inputItemIDs');
    const checkboxes = document.querySelectorAll("input[id*='checkbox-table']");

    // '清除選取項目'選項的觸發事件
    document.querySelector('#actionLinkClearAll').addEventListener('click', clearAll);

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
      });
    });

    // 全選checkbox觸發事件
    checkboxSelectAll.addEventListener('click', function(event) {

      // 取消勾選
      if (!event.target.checked) {
        clearAll();
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

    });

    // 清除已選取
    function clearAll() {
      checkboxSelectAll.checked = false;
      checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
      });
      checkedIdArr = [];

      document.querySelector("body").click();
      return;
    }

    // 刪除選取項目
    function triggerDestroyAllBtn() {

      // 將要刪除的項目id存在input欄位,用於表單提交
      inputItemIDs.value = checkedIdArr.join(',');
      document.querySelector("#formDestroyAll").submit();
    }
  });
</script>

@include('components.modals.modal-confirm-del', [
    'modalID' => 'popup-modal',
    'confirmTriggerFn' => 'triggerDestroyAllBtn',
    'confirmDelMessage' => '刪除選取資料?',
    'btnConfirmText' => '確定',
    'btnCancelText' => '取消',
])
