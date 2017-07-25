@extends('layouts.app')

@section('content')
    @if(auth()->guard('web')->user())
        <package-show :data_id="{{$id}}" :permission="false"></package-show>
    @else
        <package-show :data_id="{{$id}}" :permission="true"></package-show>
    @endif
@endsection
