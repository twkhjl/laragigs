<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <section>
    <div class="py-16">
      <div class="mx-auto px-6 max-w-6xl text-gray-500">

        @include('listings.manage')

      </div>
    </div>
</x-app-layout>
