@extends('layouts.app')

@section('content')
    <div class="panel-heading">Package List</div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Width</th>
                <th>Height</th>
                <th>Unit_measure</th>
                <th>Weight</th>
                <th>Weight_measure</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr>
                    <td>{{$package->id}}</td>
                    <td>{{$package->width}}</td>
                    <td>{{$package->height}}</td>
                    <td>{{$package->unit_measure}}</td>
                    <td>{{$package->weight}}</td>
                    <td>{{$package->weight_measure}}</td>
                    <td><span class="label label-default">{{$package->status->status}}</span></td>
                    <td class="col-sm-4">
                        @include('layouts.formButtons._form_all', array('prefix_name' => 'admin.packages', 'id' => $package->id))
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
