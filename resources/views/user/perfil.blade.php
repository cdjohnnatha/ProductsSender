@extends('layouts.app')

@section('content')
    <header class="panel-heading">
        <h4>Perfil of {{$user->name}} </h4>
    </header>
    <section class="panel-body">
        <aside class="col-sm-4">
                <section class="panel panel-primary">
                <header class="panel-heading">
                    <h3>Informations</h3>
                </header>
                    <section class="panel-body">
                        <div class="form-group">
                            <label>Name:</label>
                            <span>{{$user->name}}</span>
                        </div>
                        <div class="form-group">
                            <label>Suite number:</label>
                            <span>#{{$user->id}}</span>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <span>{{$user->country}}</span>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <span>{{$user->email}}</span>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <span>{{$user->phone}}</span>
                        </div>
                    </section>
                </section>
        </aside>
        <article class="col-sm-4">
            <section class="panel panel-info">
                <header class="panel-heading">
                    <h3>Address: {{$user->address[0]->label}}</h3>
                </header>
                <section class="panel-body">
                    @include('address.show', ['address' => $user->address[0]])
                </section>
            </section>
        </article>
        <aside>
            @include('subscription.show', ['subscription' => $user->subscription])
        </aside>
    </section>
@endsection
