@extends('layouts.app')

@section('title')
    Films
@endsection()

@section('content')
    <film-create :genres="{{json_encode($genres)}}"></film-create>
@endsection