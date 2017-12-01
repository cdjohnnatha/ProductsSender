
<section class="content-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="warehouseTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Phones</th>
                                <th data-orderable="false" class="col-xs-2">
                                    <a href="{{Route('admin.companies.warehouses.create', $company->id)}}">
                                        <button class="btn btn-primary btn-fab  animate-fab"><i class="zmdi zmdi-plus"></i></button>
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($company->warehouses as $warehouse)
                                    <tr>
                                        <td>{{$warehouse->id}}</td>
                                        <td>{{$warehouse->name}}</td>
                                        <td>{{$warehouse->address['city']}}</td>
                                        <td>{{$warehouse->address['country']}}</td>
                                        <td>
                                            @foreach($warehouse->phones as $phone)
                                                {{$phone->number . ' / '}}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="#" class="icon"
                                               onclick="window.location='{{Route("admin.companies.warehouses.show", [$company->id, $warehouse->id])}}'"
                                               data-toggle="tooltip"
                                               data-placement="top" title="{{__('buttons.titles.show')}}">
                                                <i class="zmdi zmdi-search"></i>
                                            </a>

                                            <a href="#" class="icon"
                                               onclick="window.location='{{Route("admin.companies.warehouses.edit", [$company->id, $warehouse->id])}}'"
                                               data-toggle="tooltip"
                                               data-placement="top" title="{{__('buttons.titles.edit')}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            <a href="javascript:void(0)" class="icon alerting-delete" id="delete-button-{{$warehouse->id}}"
                                               formSubmitId="delete-form-{{$warehouse->id}}" data-toggle="tooltip" data-placement="top"
                                               title="{{__('buttons.titles.delete')}}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <form action="{{route('admin.companies.warehouses.destroy', [$company->id, $warehouse->id])}}" method="POST"
                                                  role="form" id="delete-form-{{$warehouse->id}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
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
