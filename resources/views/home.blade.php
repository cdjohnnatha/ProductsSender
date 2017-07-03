@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <section>
                        <table class="table">
                            <tr>
                                <th>Name:</th>
                                <td>{{Auth::user()->name.' '.Auth::user()->surname}}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <th>Plan:</th>
                                <td>{{Auth::user()->plan}}</td>
                            </tr>
                            <tr>
                                <th>Country:</th>
                                <td>{{Auth::user()->country}}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{Auth::user()->phone}}</td>
                            </tr>
                        </table>

                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
