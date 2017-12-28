@extends('layouts.app')

@section('panel_header')
  @lang('company.company_warehouse.title')
@endsection

@section('content')
  <div class="card">
    <header class="card-heading">
      <h2 class="card-title">{{ $data['companyWarehouse']->name }}</h2>
    </header>
    <div class="card-body p-t-0">
      <div class="card card-transparent m-b-0">
        <div class="card-body p-0">
          <div class="tabpanel">
            <ul class="nav nav-tabs">
              <li class="active" role="presentation">
                <a href="#tab-5" data-toggle="tab" aria-expanded="true">@lang('company.company_warehouse.home')</a>
              </li>
              <li role="presentation">
                <a href="#tab-2" data-toggle="tab" aria-expanded="true">@lang('company.company_warehouse.addon.addons')</a>
              </li>
              <li role="presentation">
                <a href="#tab-3" data-toggle="tab" aria-expanded="true">@lang('company.company_warehouse.fee_rules')</a>
              </li>
            </ul>
          </div>
          <div class="tab-content  p-20">
            <div class="tab-pane fadeIn active" id="tab-5">
              <label for="address">@lang('company.company_warehouse.title')</label>
              <p>{{ $data['companyWarehouse']->address->formatted_address }}</p>
            </div>
            <div class="tab-pane fadeIn" id="tab-2">
              @include('company.warehouse.addon.index')
            </div>
            <div class="tab-pane fadeIn" id="tab-3">
              @include('company.warehouse.fees._table')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection