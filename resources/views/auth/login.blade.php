@extends('layouts.app')

@section('content')
    @include('auth._login', ['user_type' => '', 'title_user_login' => 'Login'])
@endsection
