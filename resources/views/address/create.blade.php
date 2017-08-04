@extends('layouts.app')

@section('content')
<header class="panel-heading">
 <h3 class="panel-title">Register Address</h3>
</header>
<form action="{{route('user.address.store', Auth::user()->id)}}" role="form" method="POST">
    <section class="panel-body">
        {{ csrf_field() }}
        @include('address._form')
    </section>
    <footer class="panel-footer">
        <div class="pull-right">
            <button type="submit" class="btn btn-success">{{ __('buttons.titles.save') }}</button>
        </div>
        <div class="clearfix"></div>
    </footer>

</form>
@endsection