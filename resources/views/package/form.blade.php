@extends('layouts.app')

@section('content')
    <package-form :data_id="{{$id}}" :user_id="{{Auth::user()->id}}"></package-form>
@endsection
