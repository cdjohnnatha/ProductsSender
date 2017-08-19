@extends('layouts.app')

@section('panel_header')
  {{ config('app.name') }} Dashboards
@endsection


@section('content')
  @include('layouts.nav-menu._content')
@endsection