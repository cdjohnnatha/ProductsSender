@extends('layouts.app')

@section('panel_header')
  {{__('common.titles.companies')}}
@endsection

@section('content')
  <div class="card">
    <header class="card-heading">
      <h2 class="card-title">{{$company->name}}</h2>
    </header>
    <div class="card-body p-t-0">
      <div class="card card-transparent m-b-0">
        <div class="card-body p-0">
          <div class="tabpanel">
            <ul class="nav nav-tabs">
              <li class="active" role="presentation"><a href="#tab-5" data-toggle="tab" aria-expanded="true">Home</a></li>
              <li role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">Addons</a></li>
              <li role="presentation"><a href="#tab-3" data-toggle="tab" aria-expanded="true">Warehouses</a></li>
            </ul>
          </div>
          <div class="tab-content  p-20">
            <div class="tab-pane fadeIn active" id="tab-5">
              <label for="address">{{__('common.titles.address')}}</label>
              <p>{{$company->address->formatted_address}}</p>
            </div>
            <div class="tab-pane fadeIn" id="tab-2">
              @include('company.addons.index')
            </div>
            <div class="tab-pane fadeIn" id="tab-3">
              @include('company.warehouse.index')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection