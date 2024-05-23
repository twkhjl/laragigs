<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('listings') }}
    </h2>
  </x-slot>

  <section>
    <div class="py-16">
      <div class="mx-auto px-6 max-w-6xl text-gray-500">

        @auth
          <button type="button" onclick="location.href='/listings/create'"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">新增</button>
        @endauth

        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
          @foreach ($listings as $key => $value)
            <div
              class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="#">
                <img class="rounded-t-lg" src="https://fakeimg.pl/800x600/?text=Hello" alt="" />
              </a>
              <div class="p-5">
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $value['title'] }}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                  {{ $value['description'] }}
                </p>
                <a href="/listings/{{ $value['id'] }}"
                  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                  了解詳情
                  <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                </a>

                @auth
                  <form method="POST" action="/listings/{{ $value['id'] }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="flex p-2">
                      <button type="submit"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">移除</button>

                      {{-- <input type="submit" class="btn btn-danger delete-user" value="Delete user"> --}}
                    </div>
                  </form>
                @endauth

              </div>
            </div>
          @endforeach
        </div>

      </div>
    </div>
  </section>



</x-app-layout>
