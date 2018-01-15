<div class="card card-data-tables" style="margin-bottom: 0;">
    <header class="panel-heading" role="tab" id="heading-fees">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#fee-rules-parent" href="#collapse-fees" aria-expanded="false" aria-controls="collapse-fees">
                @lang('company.fees.fees')
            </a>
        </h4>
    </header>
    <section id="collapse-fees" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-fees">
        <div class="panel-body">
            <article>
                <table id="fee-rulesTable" class="mdl-data-table product-table m-t-30" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>@lang('company.fees.title')</th>
                        <th>@lang('company.fees.amount')</th>
                            <th data-orderable="false" class="col-xs-2">
                                <a href="{{ Route('admin.companies.warehouses.fees.create', [$data['companyId'], $data['companyWarehouse']->id]) }}">
                                    <button class="btn btn-primary btn-fab  animate-fab"><i
                                                class="zmdi zmdi-plus"></i></button>
                                </a>
                            </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['companyWarehouse']->feeRules as $fees)
                            <tr>
                                <td>{{ $fees->title}}</td>
                                <td>{{ $fees->amount }}</td>
                                <td>
                                    <a href="#" class="icon"
                                       onclick="window.location='{{ Route('admin.companies.warehouses.fees.edit', [ $data['companyId'], $data['companyWarehouse']->id, $fees->id ]) }}'"
                                       data-toggle="tooltip"
                                       data-placement="top" title="{{ __('buttons.titles.edit') }}">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)" class="icon alerting-delete"
                                       id="delete-weight-{{ $fees->id }}"
                                       formSubmitId="delete-form-weight-{{ $fees->id }}"
                                       data-toggle="tooltip"
                                       data-placement="top" title="{{ __('buttons.titles.delete') }}">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>
                                    <form action="{{ route('admin.companies.warehouses.fees.destroy', [$data['companyId'], $data['companyWarehouse']->id, $fees->id]) }}" method="POST" role="form" id="delete-form-weight-{{ $fees->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </article>
        </div>
    </section>
</div>
