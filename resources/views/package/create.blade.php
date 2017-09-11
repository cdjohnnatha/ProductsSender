@extends('layouts.app')

@section('panel_header')
    Packages
@endsection

@section('content')

<section class="card">
  <header class="card-body p-0">
    <div class="tabpanel">
      <ul class="nav nav-tabs nav-tabs-right">
        <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">{{__('common.titles.incoming')}}</a></li>
        @if(!is_null($incoming))
          <li class="presentation" role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('common.titles.goods')}}</a></li>
        @endif
      </ul>
    </div>
  </header>
  <section class="tab-content  p-20">
      <section class="tab-pane fadeIn active" id="tab-1">
        <div class="row">
          <header class="card-heading">
            <h2 class="card-title">{{__('packages.form.title_form')}}</h2>
            <div class="card-search">
              <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                <i class="zmdi zmdi-search search-icon-left"></i>
                <input type="text" class="form-control filter-input" placeholder="Filter Packages..." autocomplete="off">
                <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
              </div>
            </div>
          </header>
          @if(Request::is('*/edit'))
                  <?php $action = 'admin.packages.update' ?>
                  <form action="{{route($action, $package->id)}}" role="form" method="POST" enctype="multipart/form-data">
                  <input name="_method" type="hidden" value="PUT">
              @else
                  <?php $action = 'admin.packages.store' ?>
                  <form action="{{route($action)}}" role="form" method="POST" enctype="multipart/form-data">
              @endif
                  {{ csrf_field() }}
                  <section class="card-body">
                      @include('package._form')
                      @if(!is_null($incoming))
                        <input type="hidden" value="{{$incoming->id}}" name="incoming">
                      @endif
                  </section>
                  <footer class="card-footer text-right">
                      @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.packages.index')])
                  </footer>
              </form>
        </div>
      </section>

      @if(!is_null($incoming))
        <section class="tab-pane" id="tab-2">
          @include('package.incoming._show', ['incomingPackage' => $incoming])
        </section>
      @endif
  </section>
</section>
@endsection