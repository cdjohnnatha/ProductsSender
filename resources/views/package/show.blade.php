@extends('layouts.app')

@section('content')
    <div class="panel-heading">
        <label>Package:</label>
        # {{$package->id}}
    </div>
    <div class="panel-body">
        <section class="col-sm-12">
            <section class="col-sm-4" id="picture-wall">
                <label>Pictures of Package</label>
                <package-pictures :pictures="{{$package->pictures}}"></package-pictures>
            </section>
            <section class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Order Informations
                    </div>
                    <div class="panel-body">
                    </div>
                </div>
            </section>
            <aside class="col-sm-4" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Object Informations
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Dimensions ({{$package->unit_measure}}):</th>
                                <td>
                                    {{$package->width}} x {{$package->height}}
                                    x {{$package->depth}}
                                </td>
                            </tr>
                            <tr>
                                <th>Weight ({{$package->weight_measure}}):</th>
                                <td>{{$package->weight}}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>{{$package->status->status}}</td>
                            </tr>
                            <tr>
                                <th>Object Owner:</th>
                                <td>{{$package->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Warehouse:</th>
                                <td>{{$package->warehouse->name}}</td>
                            </tr>
                            <tr>
                                <th>Note:</th>
                                <td>{{$package->note}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </aside>
            <footer class="pull-right col-sm-4">
                @include('layouts.formButtons._form_edit_delete', array('prefix_name' => 'admin.packages', 'id' => $package->id))
            </footer>
        </section>
    </div>
@endsection
