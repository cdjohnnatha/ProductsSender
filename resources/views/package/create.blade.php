@extends('layouts.app')
@section('content')
    <header class="panel-heading">Package</header>
    @if(Request::is('*/edit'))
        <section class="container-fluid">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <label>Uploaded Pictures</label>
                    <section>
                        <ul class="col-sm-11 pre-scrollable" style="list-style-type: none; height: 10em;">
                            @foreach($package->pictures as $picture)
                                <li class="col-sm-2" style="padding-right: 0; ">
                                    <section class="thumbnail  col-sm-12">
                                        <small-pictures-preview :pictures="{{$picture}}"></small-pictures-preview>
                                        <section class="caption">
                                            <form action="{{route('admin.packagefiles.destroy', $picture->id)}}" method="POST"  role="form">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    {{ __('buttons.titles.delete') }}
                                                </button>
                                            </form>
                                        </section>
                                    </section>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
            </div>
        </section>
        <?php $action = 'admin.packages.update' ?>
        <form action="{{route($action, $package->id)}}" role="form" method="POST" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PUT">
    @else
        <?php $action = 'admin.packages.store' ?>
        <form action="{{route($action)}}" role="form" method="POST" enctype="multipart/form-data">
    @endif
            <section class="panel-body">
                {{ csrf_field() }}
                @include('package._form')
            </section>
            <footer class="panel-footer">
                @include('layouts.formButtons._form_save_edit')
                <div class="clearfix"></div>
            </footer>
        </form>
@endsection