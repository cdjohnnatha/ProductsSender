@extends('layouts.app')

@section('content')

    @if(auth()->guard('admin')->user())
        <?php $userType = 'admin.users'; ?>
    @else
        <?php $userType = 'user'; ?>
    @endif
    <section class="container col-sm-10 col-sm-offset-1">
        <form action="{{route($userType.'.update', $user->id)}}" role="form" method="POST">
        <section class="panel panel-default">
            <header class="panel-heading">
                Edit User
            </header>
            <section class="panel-body">
                {{ csrf_field() }}
                @include('user._form', ['user' => $user])
                <input name="_method" type="hidden" value="PUT">
              <input name="users[subscription_id]" type="hidden" value="1">
            </section>
            <footer class="panel-footer">
                @include('layouts.formButtons._form_save_edit', ['url' => route($userType.'.index')])
                <div class="clearfix"></div>
            </footer>
        </section>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    </section>
@endsection
