@extends('layouts.app')
@section('content')
  <div id="content_wrapper" class="card-overlay invoice-page" style="padding-top: 0;">
    <div id="content" class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="card">
            <header class="card-heading">
              <h2 class="card-title">
                {{__('common.titles.incoming_package')}} No. {{$incomingPackage->id}} -
                {{$incomingPackage->registered ? __('common.status.registered') : __('common.status.unregistered')}}
              </h2>
              <small>{{Carbon\Carbon::parse($incomingPackage->created_at)->format('d/m/Y')}}</small>
            </header>
            @include('package.incoming._show')

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection