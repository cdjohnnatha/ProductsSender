@extends('layouts.app')

@section('content')
    <customclearance-form :user_id="{{\Illuminate\Support\Facades\Auth::user()->id}}"></customclearance-form>
@endsection
