@extends('layouts.app')

@section('panel_header')
    {{__('common.titles.package')}}
@endsection


@section('content')
    <section class="card">
      <header class="card-body p-0">
        <div class="tabpanel">
          <ul class="nav nav-tabs nav-tabs-right">
            <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">{{__('common.titles.inbox')}}</a></li>
            <li class="presentation" role="presentation"><a href="#tab-3" data-toggle="tab" aria-expanded="true">{{__('common.titles.incoming')}}</a></li>
            <li class="presentation" role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('packages.index.sent')}}</a></li>
          </ul>
        </div>
      </header>
      <header class="card-heading">

        <ul class="card-actions right-top">
          <li>
            <a href="{{route('user.incoming.create')}}" class="btn btn-info btn-flat">
              <i class="zmdi zmdi-notifications-add"></i>
              {{__('buttons.titles.incoming_package_inform')}}
            </a>
          </li>
          {{--<li>--}}
            {{--<a href="javascript:void(0)" class="btn btn-info btn-flat">--}}
              {{--<i class="zmdi zmdi-mail-send"></i>--}}
              {{--{{__('buttons.titles.send_package')}}--}}
            {{--</a>--}}
          {{--</li>--}}
          <li>
            <a href="javascript:void(0)" class="btn btn-info btn-flat">
              <i class="zmdi zmdi-group"></i>
              Merge packages
            </a>
          </li>
        </ul>
      </header>

        <section class="tab-content  p-20">

          <section class="tab-pane fadeIn active" id="tab-1">
            <h2 class="card-title">{{__('common.titles.package')}}</h2>
            <small class="dataTables_info">{{__('packages.index.short_description')}}</small>

            <div class="row">
              <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                  @include('package._table', ['packages' => $packages_warehouse, 'table_id' => 'productsTable-warehouse'])
                </div>
              </div>
            </div>
          </section>

          <section class="tab-pane fadeIn" id="tab-2">

            <h2 class="card-title">{{__('common.titles.package')}}</h2>
            <small class="dataTables_info">{{__('packages.index.short_description_warehouse')}}</small>

            <div class="row">
              <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                  @if($sent)
                    @include('package._table', ['packages' => $sent, 'table_id' => 'productsTable-all'])
                  @endif
                </div>
              </div>
            </div>
          </section>

          <section class="tab-pane fadeIn" id="tab-3">
            <h2 class="card-title">{{__('common.titles.package')}}</h2>
            <small class="dataTables_info">{{__('packages.incoming.form.short_description')}}</small>

            <div class="row">
              <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                  @include('package.incoming._table', ['table_id' => 'incoming-table'])
                </div>
              </div>
            </div>
          </section>

      </section>
@endsection