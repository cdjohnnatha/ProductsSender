@extends('layouts.app')

@section('content')
<header class="panel-heading">
 <h3 class="panel-title">Register Address</h3>
</header>
<form action="{{route('user.address.store', Auth::user()->id)}}" role="form" method="POST">
    <section class="panel-body">
        {{ csrf_field() }}
        @include('address._form', ['title' => 'Give a name for your address'])
    </section>
    <footer class="panel-footer">
        @include('layouts.formButtons._form_save_edit', ['url' => route('user.address.index', Auth::user()->id)])
        <div class="clearfix"></div>
    </footer>

</form>
@endsection