@extends('layouts.app')

@section('content')
    <notifications :user_id="{{Auth::user()->id}}"></notifications>
@endsection
