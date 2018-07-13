@extends('base')

@section('title')
    Film {{ $film->name }}
@endsection()

@section('content')
    <div class="card card-default">
        <img class="card-img-top" src="{{ $film->photo_url }}" style="height: 180px; width: 100%; display: block;">
        <div class="card-header">
            <span :v-show="currentName">{{ $film->name }}</span>
        </div>

        <div class="card-body">
            <ul class="mb-3">
                @foreach ($film->getAttributes() as $key => $value)

                    <li>
                        {{$key}}: {{$value}}
                    </li>

                @endforeach
            </ul>

        </div>
    </div>
@endsection