<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
      <th scope="col" class="px-6 py-3">
        title
      </th>
      <th scope="col" class="px-6 py-3">
        Company
      </th>
      <th scope="col" class="px-6 py-3">
        email
      </th>
      <th scope="col" class="px-6 py-3">
        tags
      </th>
      <th scope="col" class="px-6 py-3 text-center">
        Action
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
          tag
        </td>
        <td class="px-6 py-4">
          <div class="flex gap-4 align-middle justify-center">
            <a href="/listings/{{$value->id}}/edit"
              class="block focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"><i
                class="fa-solid fa-pen"></i></a>

            <form method="POST" action="/listings/{{$value->id}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <input type="text" hidden name="srcPage" value="manage">

              <button type="submit"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><i
                  class="fa-solid fa-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>
    @endforeach

  </tbody>
</table>
