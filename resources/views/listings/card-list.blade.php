@foreach ($listings as $key => $listing)
  @php
    $imgUrl = 'https://fakeimg.pl/400x300/?text=' . 'no image';
    if ($listing->logo) {
        $imgUrl = $listing->logo;
    }

    $detailUrl = "/listings/{$listing->id}";
  @endphp
  <div class="m-5">

    <div
      class="group mx-2 grid max-w-screen-lg grid-cols-1 space-x-8 overflow-hidden rounded-lg border text-gray-700 shadow transition hover:shadow-lg sm:mx-auto sm:grid-cols-5">
      <a href="{{ $detailUrl }}" class="col-span-2 text-left text-gray-600 hover:text-gray-700">
        <div class="group relative h-full w-full overflow-hidden">
          <img src="{{ $imgUrl }}" alt=""
            class="h-full w-full border-none object-cover text-gray-700 transition group-hover:scale-125" />
          {{-- <span
            class="absolute top-2 left-2 rounded-full bg-yellow-200 px-2 text-xs font-semibold text-yellow-600">Unity</span> --}}
          <img src=""
            class="absolute inset-1/2 w-10 max-w-full -translate-x-1/2 -translate-y-1/2 transition group-hover:scale-125"
            alt="" />
        </div>
      </a>
      <div class="col-span-3 flex flex-col space-y-3 pr-8 text-left">
        <a href="{{ $detailUrl }}" class="mt-3 invisible sm:visible overflow-hidden text-2xl font-semibold">
          {{ Str::limit($listing->title, 50, '...') }}
        </a>
        <a href="{{ $detailUrl }}" class="mt-3 sm:hidden overflow-hidden text-2xl font-semibold">
          {{ Str::limit($listing->title, 15, '...') }}
        </a>

        <p class="overflow-hidden text-sm invisible sm:visible">{{ Str::limit($listing->description, 100, '...') }}</p>
        <p class="overflow-hidden text-sm sm:hidden">{{ Str::limit($listing->description, 20, '...') }}</p>

        <a href="{{ $detailUrl }}"
          class="text-sm font-semibold text-gray-500 hover:text-gray-700">{{ $listing->company }}</a>

        <div class="flex flex-col text-gray-700 sm:flex-row">
          <div class="flex h-fit space-x-2 text-sm font-medium">
            @if ($listing->tags)
              @php
                $tags = collect(json_decode($listing->tags));
              @endphp
              @foreach ($tags as $key => $tag)
                <div class="rounded-full bg-green-100 px-2 py-0.5 text-green-700">{{ $tag->value }}</div>
              @endforeach
            @endif

          </div>
          <a href="/listings/{{ $listing->id }}"
            class="my-5 rounded-md px-5 py-2 text-center transition hover:scale-105 bg-orange-600 text-white sm:ml-auto">查看更多
          </a>
        </div>
      </div>
    </div>


  </div>
  @php
    $imgUrl = 'https://fakeimg.pl/400x300/?text=' . 'no image';
    if ($listing->logo) {
        $imgUrl = $listing->logo;
    }
  @endphp
  {{-- <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
      <img class="rounded-t-lg" src="{{ $imgUrl }}" alt="" />
    </a>
    <div class="p-5">
      <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
          {{ $listing->title }}</h5>
      </a>
      <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
        {{ $listing->description }}
      </p>
      <a href="/listings/{{ $listing->id }}"
        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        了解詳情
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
      </a>
    </div>
  </div> --}}
@endforeach
