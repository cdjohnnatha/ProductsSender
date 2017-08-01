@extends('layouts.app')

@section('content')
    @if(auth()->guard('web')->user())
        <package-show :data_id="{{$id}}" :permission="false" :user_id="{{Auth::user()->id}}"></package-show>
    @else
        <package-show :data_id="{{$id}}" :permission="true" :user_id="{{Auth::user()->id}}"></package-show>
    @endif
@endsection
