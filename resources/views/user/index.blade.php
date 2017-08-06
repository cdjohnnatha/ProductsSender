@extends('layouts.app')

@section('content')
    <div class="panel-heading">Users</div>
    <div class="panel-body">
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
                    <td>{{ $user->subscription }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <a class="edit-modal btn btn-warning">
                            <span class="glyphicon glyphicon-edit"></span>
                            Edit
                        </a>
                        <button class="edit-modal btn btn-error">
                            <span class="glyphicon glyphicon-trash"></span>
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
