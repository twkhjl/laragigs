<form action="/dashboard" class="flex">
  <label for="table-search" class="sr-only">搜尋</label>

  <div class="relative mb-2">
    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
      <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
      </svg>
    </div>
    <input type="text" name="search" @if (request('search')) value="{{ request('search') }}" @endif
      class="block p-2 ps-10 text-sm text-gray-900 
       rounded-lg w-80 
       focus:ring-blue-500 focus:border-blue-500 
       dark:placeholder-gray-400 
        dark:focus:ring-blue-500 dark:focus:border-blue-500"
      placeholder="輸入關鍵字">
  </div>
  <button type="submit"
    class="ml-2 mr-0 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">搜尋</button>
</form>
