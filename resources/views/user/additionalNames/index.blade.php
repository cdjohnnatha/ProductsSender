@extends('layouts.app')

@section('content')
    <header class="panel-heading">
        <label>
            Additional Names
        </label>
        <p>
            Those listed names bellow belongs to your Holyship account. All the
            consignment which will be send to them, using the EUA Address
            will be put it out on the packages
        </p>
    </header>
    <section class="panel-body">
        <form action="{{route('user.additional-names.store', Auth::user()->id)}}" role="form" method="POST" >
            {{ csrf_field() }}
           <user-additional-names :editing="{{$names}}" :user_id="{{Auth::user()->id}}"></user-additional-names>
        </form>
    </section>
@endsection
