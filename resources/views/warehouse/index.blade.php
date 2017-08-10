@extends('layouts.app')

@section('content')
<div class="panel-heading">Warehouses</div>
<div class="panel-body">
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Box Price</th>
            <th>Address</th>
            <th>City</th>
            <th>Country</th>
            <th>State</th>
            <th>Postal Code</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($warehouses as $warehouse)
            <tr>
                <td>{{$warehouse->id}}</td>
                <td>{{$warehouse->address['label']}}</td>
                <td>{{$warehouse->box_price}}</td>
                <td>{{$warehouse->address['address']}}</td>
                <td>{{$warehouse->address['city']}}</td>
                <td>{{$warehouse->address['country']}}</td>
                <td>{{$warehouse->address['state']}}</td>
                <td>{{$warehouse->address['postal_code']}}</td>
                <td class="col-sm-3">
                   @include('layouts.formButtons._form_edit_delete', array('prefix_name' => 'admin.warehouses', 'id' => $warehouse->id))
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
