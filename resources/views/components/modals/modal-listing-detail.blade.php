

<!-- Large Modal -->
<div id="large-modal{{ $listing->id }}" tabindex="-1"
  class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div style="background:white;color:black;" class="relative w-full max-w-4xl max-h-full">
    <!-- Modal content -->
    <div style="background:white;color:black;" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-medium">
          職缺詳細
        </h3>
        <button id="closeBtn{{ $listing->id }}" type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-md w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="large-modal{{ $listing->id }}">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div style="background:white;color:black;" class="p-4 md:p-5 space-y-4">
        <div>
          <dl>
            <div class="flex justify-center px-4 py-5 sm:px-6">
              <img src="{{ $listing->imgUrl }}" class="w-1/2 h-full" alt="" srcset="">
            </div>

            <div class=" px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-md font-medium ">
                職缺名稱
              </dt>
              <dd class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $listing->title }}
              </dd>
            </div>

            <div class=" px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-md font-medium ">
                關鍵字
              </dt>
              <dd class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-2">
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
              </dd>
            </div>

            <div class=" px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-md font-medium ">
                職缺描述
              </dt>
              <dd class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-2">
                {!! nl2br($listing->description) !!}
              </dd>
            </div>


            <div class=" px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-md font-medium ">
                聯絡信箱
              </dt>
              <dd class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $listing->email }}
              </dd>
            </div>


          </dl>
        </div>

      </div>

    </div>
  </div>
</div>
