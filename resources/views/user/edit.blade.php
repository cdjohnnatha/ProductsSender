@extends('layouts.app')

@section('content')
    <section class="container col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <header class="panel-heading">
                Edit User
            </header>
            <section class="panel-body">
            {{ Form::model($user, ['method' =>'PATCH', 'url' => '/user/'.$user->id])}}
                <div class="form-group">
                    <div class="form-group col-sm-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{$user->name}}">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="name">Surname</label>
                        <input type="text" name="surname" id="surname" class="form-control"
                               value="{{$user->surname}}">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="country">Country</label>
                        {{ Form::select('country', ['Brasil' => 'Brasil', 'Canada' => 'Canada', 'USA' => 'USA'],
                        null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group col-sm-8">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                        value="{{$user->email}}">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                        value="{{$user->phone}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group pull-right">
                        <a href="/home/all" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                            Save
                        </button>
                    </div>
                </div>
            {{Form::close()}}
            </section>
        </div>
    </section>
@endsection
