@extends('layouts.app')

@section('content')
    <user-packages :data_id="{{Auth::user()->id}}"></user-packages>
@endsection
