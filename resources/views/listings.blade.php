@foreach ($listings as $key => $value)
    <h1>
        <a href="/listings/{{ $value['id'] }}">
            {{ $value['name'] }}
        </a>
    </h1>
    <p>{{ $value['description'] }}</p>
@endforeach
