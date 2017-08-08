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
                        @include('layouts.formButtons._form_edit_delete',
                                array('prefix_name' => 'admin.users',
                                    'id' => $user->id))
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
