@extends('layouts.app')

@section('panel_header')
    Packages
@endsection


@section('content')
    <section class="card">
      <header class="card-body p-0">
        <div class="tabpanel">
          <ul class="nav nav-tabs nav-tabs-right">
            <li class="presentation" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">Index</a></li>
            <li class="active" role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('common.titles.warehouse')}}</a></li>
          </ul>
        </div>
      </header>
      <header class="card-heading">
        <h2 class="card-title">{{__('common.titles.package')}}</h2>
        <small class="dataTables_info">{{__('packages.index.short_description')}}</small>
        <div class="card-search">
          <div id="productsTable_wrapper" class="form-group label-floating is-empty">
            <i class="zmdi zmdi-search search-icon-left"></i>
            <input type="text" class="form-control filter-input" placeholder="Filter Packages..." autocomplete="off">
            <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
          </div>
        </div>
        <ul class="card-actions right-top">
          <li>
            <a href="javascript:void(0)" class="btn btn-info btn-flat">
              <i class="zmdi zmdi-notifications-add"></i>
              Inform incoming package
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" class="btn btn-info btn-flat">
              <i class="zmdi zmdi-mail-send"></i>
              Send package
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" class="btn btn-info btn-flat">
              <i class="zmdi zmdi-group"></i>
              Merge packages
            </a>
          </li>
        </ul>
      </header>

        <section class="tab-content  p-20">

          <section class="tab-pane fadeIn" id="tab-1">
            <div class="row">
              <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                  @include('package._table', ['packages' => $packages, 'table_id' => 'productsTable-all'])
                </div>
              </div>
            </div>
          </section>

          <section class="tab-pane fadeIn active" id="tab-2">
            <div class="row">
              <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                  @include('package._table', ['packages' => $packages_warehouse, 'table_id' => 'productsTable-warehouse'])
                </div>
              </div>
            </div>
          </section>

      </section>
@endsection