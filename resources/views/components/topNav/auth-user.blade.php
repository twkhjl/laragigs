@php
  $iconUrl = App\Models\Img::getOneImgUrl([
      'table_name' => 'users',
      'table_id' => auth()->id(),
  ]);

  if (!$iconUrl) {
      $iconUrl = asset('images/user-icon.png');
  }
@endphp
<div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
  <button type="button"
    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
    <span class="sr-only">Open user menu</span>
    <img class="w-8 h-8 rounded-full" src="{{ $iconUrl }}" alt="user photo">
  </button>
  <!-- Dropdown menu -->
  <div
    class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
    id="user-dropdown">
    <div class="px-4 py-3">
      <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
      <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
    </div>
    <ul class="py-2" aria-labelledby="user-menu-button">
      <li>
        <a href="{{ route('userInfo.edit', Auth::user()->id) }}"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">設定</a>
      </li>

      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                                  this.closest('form').submit();"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">登出</a>
        </form>
      </li>
    </ul>
  </div>
  <button data-collapse-toggle="navbar-user" type="button"
    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
    aria-controls="navbar-user" aria-expanded="false">
    <span class="sr-only">Open main menu</span>
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M1 1h15M1 7h15M1 13h15" />
    </svg>
  </button>
</div>