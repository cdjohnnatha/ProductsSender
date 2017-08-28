@extends('layouts.app')

@section('panel_header')
    Package #{{$package->id}}
@endsection


@section('content')
<section class="card">
    <header class="card-body p-0">
        <div class="tabpanel">
            <ul class="nav nav-tabs nav-tabs-right">
                <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">{{__('common.titles.general')}}</a></li>
                <li role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('common.titles.address')}}</a></li>
                <li role="presentation"><a href="#tab-3" data-toggle="tab" aria-expanded="true">{{__('common.titles.order_info')}}</a></li>
                <li role="presentation"><a href="#tab-4" data-toggle="tab" aria-expanded="true">{{__('common.titles.comments')}}</a></li>
                @if(count($package->pictures) >= 8)
                    <li role="presentation"><a href="#tab-5" id="galery-tab" data-toggle="tab" aria-expanded="true">Galery</a></li>
                @endif
            </ul>
        </div>
    </header>
    <section class="tab-content  p-20">
        <section class="tab-pane fadeIn active" id="tab-1">
            @include('package.fragments._informations')
        </section>
        <section class="tab-pane fadeIn" id="tab-2">

        </section>

        <section class="tab-pane fadeIn" id="tab-3">

        </section>

        <section class="tab-pane fadeIn" id="tab-4">

        </section>

        <section class="tab-pane fadeIn" id="tab-5">
            @include('package.fragments._image_galery')
        </section>
    </section>
    @include('package.fragments._photoswipe_element')
</section>
@endsection

