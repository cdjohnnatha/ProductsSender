@extends('layouts.app')

@section('panel_header')
  {{__('packages.index.package')}} #{{$package->id}}
@endsection


@section('content')
  <section class="card">
    <header class="card-body p-0">
      <div class="tabpanel">
        <ul class="nav nav-tabs nav-tabs-right">
          <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab"
                                                    aria-expanded="true">{{__('common.titles.general')}}</a></li>
          <li role="presentation"><a href="#tab-2" data-toggle="tab"
                                     aria-expanded="true">{{__('common.titles.address')}}</a></li>
          <li role="presentation"><a href="#tab-3" data-toggle="tab"
                                     aria-expanded="true">{{__('common.titles.order_info')}}</a></li>
          <li role="presentation"><a href="#tab-4" data-toggle="tab"
                                     aria-expanded="true">{{__('common.titles.comments')}}</a></li>
          @if(count($package->pictures) >= 8)
            <li role="presentation"><a href="#tab-5" id="galery-tab" data-toggle="tab" aria-expanded="true">Galery</a>
            </li>
          @endif
          @if(!is_null($package->goodsDeclaration()))
            <li class="presentation" role="presentation">
              <a href="#tab-6" data-toggle="tab" aria-expanded="true">
                {{__('common.titles.custom_clearance')}}
              </a>
            </li>
          @endif
        </ul>
      </div>
    </header>
    <section class="tab-content  p-20">
      <section class="tab-pane fadeIn active" id="tab-1">
        @include('package.fragments._informations')
      </section>
      <section class="tab-pane fadeIn" id="tab-2">
        @include('address._package_address')
      </section>

      <section class="tab-pane fadeIn" id="tab-3">

      </section>

      <section class="tab-pane fadeIn" id="tab-4">

      </section>

      <section class="tab-pane fadeIn" id="tab-5">
        @include('package.fragments._image_galery')
      </section>

      <section class="tab-pane" id="tab-6">
          @include('package._custom_clearance')
      </section>
    </section>
    @include('package.fragments._photoswipe_element')
  </section>
@endsection

