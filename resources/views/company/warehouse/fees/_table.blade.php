<section class="content-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table id="fee-rulesTable" class="mdl-data-table product-table m-t-30" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>@lang('company.fee_rules.initial_fee')</th>
                                    <th>@lang('company.fee_rules.max_weight')</th>
                                    <th>@lang('company.fee_rules.over_weight')</th>

                                    <th data-orderable="false" class="col-xs-2">
                                        <a href="{{ Route('admin.companies.warehouses.fee-rules.create', [$data['companyId'], $data['companyWarehouse']->id]) }}">
                                            <button class="btn btn-primary btn-fab  animate-fab"><i
                                                        class="zmdi zmdi-plus"></i></button>
                                        </a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['companyWarehouse']->fees as $fee)
                                    <tr>
                                        <td>{{ $fee->initial_fee }}</td>
                                        <td>{{ $fee->max_weight_fee }}</td>
                                        <td>{{ $fee->overweight_fee }}</td>
                                        <td>
                                            <a href="#" class="icon"
                                               onclick="window.location='{{ Route('admin.companies.warehouses.fee-rules.edit', [$data['companyId'], $data['companyWarehouse']->id, $fee->id]) }}'"
                                               data-toggle="tooltip"
                                               data-placement="top" title="{{__('buttons.titles.edit')}}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            <a href="javascript:void(0)" class="icon alerting-delete"
                                               id="delete-button-{{$fee->id}}"
                                               formSubmitId="delete-form-{{$fee->id}}" data-toggle="tooltip"
                                               data-placement="top" title="{{__('buttons.titles.delete')}}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <form action="{{route('admin.companies.warehouses.fee-rules.destroy', [$data['companyId'], $data['companyWarehouse']->id, $fee->id])}}"
                                                  method="POST" role="form" id="delete-form-{{$fee->id}}">
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
    </div>
</section>