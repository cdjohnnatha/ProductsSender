@extends('layouts.app')

@section('content')
    <additional-names :user_id="{{Auth::user()->id}}"></additional-names>
@endsection
