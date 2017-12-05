@extends('layouts.app')

@section('panel_header')
  {{__('packages.index.title_package_warehouse')}}
@endsection


@section('content')
  <section>
    <header class="card-body p-0">
      <div class="tabpanel">
        <ul class="nav nav-tabs nav-tabs-right">
          <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">Index</a></li>
          <li class="presentation" role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('common.titles.incoming')}}</a></li>
        </ul>
      </div>
    </header>
    <article class="tab-content">
      <section class="tab-pane fadeIn active" id="tab-1">
        <section class="content-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="card card-data-tables product-table-wrapper">
                <header class="card-heading">
                  <h2 class="card-title">{{__('common.titles.packages')}}</h2>
                  <small class="dataTables_info">{{__('packages.index.short_description')}}</small>

                  <div class="card-search">
                    <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                      <i class="zmdi zmdi-search search-icon-left"></i>
                      <input type="text" class="form-control filter-input" placeholder="Filter Products..."
                             autocomplete="off">
                      <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip"
                         data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
                    </div>
                  </div>
                  <ul class="card-actions icons right-top">
                    <li id="deleteItems" style="display: none;">
                      <span class="label label-info pull-left m-t-5 m-r-10 text-white"></span>
                      <a href="javascript:void(0)" id="confirmDelete" data-toggle="tooltip" data-placement="top"
                         data-original-title="Delete Product(s)">
                        <i class="zmdi zmdi-delete"></i>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:void(0)" data-card-search="open" data-toggle="tooltip" data-placement="top"
                         data-original-title="Filter Products">
                        <i class="zmdi zmdi-filter-list"></i>
                      </a>
                    </li>
                    <li class="dropdown" data-toggle="tooltip" data-placement="top" data-original-title="Show Entries">
                      <a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="zmdi zmdi-more-vert"></i>
                      </a>
                      <div id="dataTablesLength">
                      </div>
                    </li>
                  </ul>
                </header>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    @include('package.admin._table_package', ['idName' => 'indexPackages', 'packages' => $indexPackages])
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </section>
      <!-- End packages table -->

      <!-- Incoming section-->
      <section class="tab-pane fadeIn" id="tab-2">
        <div class="row">
          <div class="col-xs-12">
            <div class="card card-data-tables product-table-wrapper">
              <div class="card-body p-0">
                <header class="card-heading">
                  <h2 class="card-title">{{__('common.titles.incoming_package')}}</h2>
                  <small
                    class="dataTables_info">{{__('common.short_description.main', ['entity' => 'incoming package'])}}</small>
                </header>
                @include('package.admin._table_package', ['idName' => 'incomingPackages', 'packages' => $incomingPackages])
              </div>
            </div>
          </div>
        </div>
      </section>

    </article>
  </section>
@endsection