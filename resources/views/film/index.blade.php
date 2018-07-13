@extends('base')

@section('title')
    Films
@endsection()

@section('content')
    <film-list :initial-page="{{request('page', 1)}}"></film-list>
@endsection