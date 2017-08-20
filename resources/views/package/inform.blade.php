@extends('layouts.app')

@section('content')
    <div class="panel-heading">Inform New Package</div>
    <div class="panel-body">
        <form action="/user/1/test" role="form" method="POST">

            <section>
                {{ csrf_field() }}
                    <div class="form-group col-sm-6">
                        <label for="provider">Provider</label>
                        <input type="text" id="provider" class=form-control>
                        <label>Warehouse</label>
                        <warehouses-select></warehouses-select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Addressee</label>
                        <select class="form-control" name="addressee"></select>
                        <label for="tracknumber">Tack Number</label>
                        <input type="text" name="tracknumber" class="form-control" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Note</label>
                        <textarea class="form-control"></textarea>
                    </div>
            </section>
            {{--<customclearance-table></customclearance-table>--}}
            <button>submit</button>
        </form>
    </div>
@endsection
