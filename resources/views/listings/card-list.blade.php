@foreach ($listings as $key => $listing)
  @php
    $listing->imgUrl = asset('images/logo.png');
    if ($listing->logo) {
        $listing->imgUrl = $listing->logo;
    }

    $detailUrl = "/listings/{$listing->id}";
  @endphp
  <div class="m-5">

    <div
      class="group mx-2 grid max-w-screen-lg grid-cols-1 space-x-8 overflow-hidden rounded-lg border text-gray-700 shadow transition hover:shadow-lg sm:mx-auto sm:grid-cols-5">
      <a href="{{ $detailUrl }}" class="col-span-2 text-left text-gray-600 hover:text-gray-700">
        <div class="group relative h-full w-full overflow-hidden">
          <img src="{{ $listing->imgUrl }}" alt=""
            class="h-full w-full border-none object-cover text-gray-700 transition group-hover:scale-125" />

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

          <button id="openBtn{{ $listing->id }}" data-modal-target="large-modal{{ $listing->id }}"
            data-modal-toggle="large-modal{{ $listing->id }}"
            class="my-5 rounded-md px-5 py-2 text-center transition hover:scale-105 bg-orange-600 text-white sm:ml-auto">查看更多
          </button>

          @include('components.modals.modal-listing-detail', [
              'listing' => $listing,
          ])

        </div>
      </div>
    </div>


  </div>
@endforeach
