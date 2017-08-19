@extends('layouts.app')

@section('content')

  @include('auth._login', ['title_user_login' => 'Login Admin', 'user_type' => 'admin.'])

@endsection
