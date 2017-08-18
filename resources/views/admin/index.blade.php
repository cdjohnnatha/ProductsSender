@extends('layouts.admin')

@section('content')

    <div class="panel-heading">Admin</div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>{{ __('admin.form.name') }}</th>
                <th>{{ __('admin.form.surname') }}</th>
                <th>{{ __('admin.form.country') }}</th>
                <th>Email</th>
                <th>{{ __('admin.form.phone') }}</th>
                <th>{{ __('admin.form.actions') }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->surname}}</td>
                        <td>{{$admin->country}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->phone}}</td>
                        <td>
                            <div class="col-sm-4">
                                <a href="{{route('admin.edit', $admin->id)}}" class="edit-modal btn btn-warning">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    {{ __('buttons.titles.edit') }}
                                </a>
                            </div>
                            <form action="{{route('admin.destroy', $admin->id)}}" method="POST"  role="form" class="col-sm-8">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" id="delete-{{$admin->id}}" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    {{ __('buttons.titles.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
