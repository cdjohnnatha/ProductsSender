@extends('layouts.app')

@section('content')
    <user-menu :data_id="{{Auth::user()->id}}"></user-menu>
    <user-packages :data_id="{{Auth::user()->id}}"></user-packages>
@endsection
