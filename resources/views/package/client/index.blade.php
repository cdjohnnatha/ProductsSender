@extends('layouts.app')

@section('panel_header')
    {{ __('packages.index.title_package') }}
@endsection


@section('content')
    <section class="card">
      <header class="card-body p-0">
        <div class="tabpanel">
          <ul class="nav nav-tabs nav-tabs-right">
            <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">{{__('packages.index.inbox')}}</a></li>
            <li class="presentation" role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('packages.index.incoming')}}</a></li>
            <li class="presentation" role="presentation"><a href="#tab-3" data-toggle="tab" aria-expanded="true">{{__('packages.index.sent')}}</a></li>
          </ul>
        </div>
      </header>
      <header class="card-heading">

        <ul class="card-actions right-top">
          <li>
            <a href="{{ route('user.packages.create') }}" class="btn btn-info btn-flat">
              <i class="zmdi zmdi-notifications-add"></i>
              {{ __('buttons.titles.incoming_package_inform') }}
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
            <h2 class="card-title">{{ __('packages.index.title_package') }}</h2>
            <small class="dataTables_info">{{__('packages.index.short_description')}}</small>

            <div class="row">
              <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                  @include('package._table', ['packages' => $packagesRegistered, 'table_id' => 'productsTable-warehouse'])
                </div>
              </div>
            </div>
          </section>


          <section class="tab-pane fadeIn" id="tab-2">
            <h2 class="card-title">{{__('packages.index.incoming')}}</h2>
            <small class="dataTables_info">{{__('packages.index.incoming_short_description')}}</small>

            <div class="row">
              <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                  @include('package._table', ['packages' => $packagesIncoming,'table_id' => 'incoming-table'])
                </div>
              </div>
            </div>
          </section>

          <section class="tab-pane fadeIn" id="tab-3">
            <h2 class="card-title">{{__('packages.index.sent')}}</h2>
            <small class="dataTables_info">{{__('packages.index.sent_short_description')}}</small>

            <div class="row">
              <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                  @include('package._table', ['packages' => $packagesSent, 'table_id' => 'productsSent'])
                </div>
              </div>
            </div>
          </section>
      </section>
@endsection