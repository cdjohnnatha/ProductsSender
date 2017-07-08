@extends('layouts.app')

@section('content')
    <section class="container">
        <article>
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Subscription</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->subscription->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <a href="{{'users/'.$user->id.'/edit'}}" class="edit-modal btn btn-warning">
                                <span class="glyphicon glyphicon-edit"></span>
                                Edit
                            </a>
                            {{Form::open(['method' => 'DELETE', 'url'=>'admin/users/'.$user->id, 'style' => 'display:inline'])}}
                                <button type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span> Delete</button>
                            {{Form::close()}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </article>
    </section>
@endsection
