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
                    <table id="productsTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                      <thead>
                      <tr>
                        <th class="col-sm-1">Id</th>
                        <th class="col-sm-2">Picture</th>
                        <th class="col-sm-1">Suite</th>
                        <th class="col-sm-2">Status</th>
                        <th>Content Type</th>
                        <th>Note</th>
                        <th data-orderable="false" class="col-xs-2">
                          <a href="{{Route('admin.packages.create')}}">
                            <button class="btn btn-primary btn-fab  animate-fab"><i class="zmdi zmdi-plus"></i></button>
                          </a>
                        </th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($warehousePackages as $package)
                        <tr>
                          <td>{{ $package->id }}</td>
                          <td>
                            @if(count($package->pictures) > 0)
                              <img src="{{$package->pictures[0]->path}}" alt="" class="img-thumbnail"/>
                            @endif
                          </td>
                          <td>{{$package->client->id .' - '.$package->client->name}}</td>
                          <td><span class="label label-default">{{$package->packageStatus->message}}</span></td>
                          <td>{{ $package->content_type }}</td>
                          <td>{{ $package->note }}</td>
                          <td>
                            @include('layouts.formButtons._form_all', ['prefix_name' => 'admin.packages' ,'id' => $package->id])
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
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
{{--                @include('package.incoming._table', ['table_id' => 'incoming'])--}}
              </div>
            </div>
          </div>
        </div>
      </section>

    </article>
  </section>
@endsection