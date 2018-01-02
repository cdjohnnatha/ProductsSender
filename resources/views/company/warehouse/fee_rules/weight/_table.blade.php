<div class="card card-data-tables" style="margin-bottom: 0;">
    <header class="panel-heading" role="tab" id="heading-weight">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-weight" aria-expanded="false" aria-controls="collapse-weight">
                @lang('company.fees.weight.title')
            </a>
        </h4>
    </header>
    <section id="collapse-weight" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-weight">
        <div class="panel-body">
            <article>
                <table id="fee-rulesTable" class="mdl-data-table product-table m-t-30" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>@lang('company.fees.weight.initial_fee')</th>
                        <th>@lang('company.fees.weight.max_weight')</th>
                        <th>@lang('company.fees.weight.over_weight')</th>
                        @if(!$data['companyWarehouse']->feeWeightRules)
                            <th data-orderable="false" class="col-xs-2">
                                <a href="{{ Route('admin.companies.warehouses.fees.weight.create', [$data['companyId'], $data['companyWarehouse']->id]) }}">
                                    <button class="btn btn-primary btn-fab  animate-fab"><i
                                                class="zmdi zmdi-plus"></i></button>
                                </a>
                            </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @if($data['companyWarehouse']->feeWeightRules)
                            <td>{{ $data['companyWarehouse']->feeWeightRules->initial_fee }}</td>
                            <td>{{ $data['companyWarehouse']->feeWeightRules->max_weight_fee }}</td>
                            <td>{{ $data['companyWarehouse']->feeWeightRules->overweight_fee }}</td>
                            <td>
                                <a href="#" class="icon"
                                   onclick="window.location='{{ Route('admin.companies.warehouses.fees.weight.edit', [$data['companyId'], $data['companyWarehouse']->id, $data['companyWarehouse']->feeWeightRules->id]) }}'"
                                   data-toggle="tooltip"
                                   data-placement="top" title="{{ __('buttons.titles.edit') }}">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>

                                <a href="javascript:void(0)" class="icon alerting-delete"
                                   id="delete-weight"
                                   formSubmitId="delete-form-weight"
                                   data-toggle="tooltip"
                                   data-placement="top" title="{{ __('buttons.titles.delete') }}">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                                <form action="{{ route('admin.companies.warehouses.fees.weight.destroy', [$data['companyId'], $data['companyWarehouse']->id, $data['companyWarehouse']->feeWeightRules->id]) }}" method="POST" role="form" id="delete-form-weight">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </article>
        </div>
    </section>
</div>
