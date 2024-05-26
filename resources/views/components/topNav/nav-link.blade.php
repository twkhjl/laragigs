@php
  $defaultCss = "
  block py-2 px-3 text-white rounded md:bg-transparent md:p-0";

  $activeCss = "
  block py-2 px-3 text-blue rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500";

  $currentCss = $defaultCss;

  if ($attributes['active'] || Route::currentRouteName() == $attributes['routeName']) {
      $currentCss = $activeCss;
  }

@endphp

<li>
  <a href="{{ route($attributes['routeName']) }}" class="{{ $currentCss }}">
    {{ $attributes['linkDisplayName'] }}
  </a>
</li>
