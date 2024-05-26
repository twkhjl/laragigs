<nav class="bg-white border-gray-200 dark:bg-gray-900 fixed w-full z-50">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('images/logo.png') }}" class="h-8" alt="logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">找工作</span>
    </a>
    @guest
      <x-topNav.unauth-user />
    @endguest
    @auth
      @if (auth()->user()->hasVerifiedEmail())
        <x-topNav.auth-user />
      @else
        <x-topNav.unauth-user />
      @endif
    @endauth
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
      <ul
        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

        <x-topNav.nav-link active="{{ in_array(Route::currentRouteName(), 
        [
          'index',
          'listings.index',
          'listings.show',
          'listings.searchResult',
        ]) }}" routeName="index"
          linkDisplayName="首頁" />
        @auth
          @if (auth()->user()->hasVerifiedEmail())
            <x-topNav.nav-link active="{{ in_array(Route::currentRouteName(), 
              [
                'listings.create',
                'listings.edit',
              ]) }}"
              routeName="dashboard" linkDisplayName="職缺列表" />

            </li>
          @endif

        @endauth

      </ul>
    </div>
  </div>
</nav>
