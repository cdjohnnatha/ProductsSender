<div class="table-responsive">
    <table id="productsTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Phones</th>
            <th>Country</th>
            <th data-orderable="false" class="col-xs-2">
                <a href="{{ Route('admin.companies.warehouses.fee-rules.create', []) }}">
                    <button class="btn btn-primary btn-fab  animate-fab"><i class="zmdi zmdi-plus"></i></button>
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        {{--@foreach($fees as $fee)--}}
            <tr>
                <td></td>
                <td>
                    {{--@include('layouts.formButtons._form_all', ['prefix_name' => 'admin.companies' ,'id' => $company->id])--}}
                </td>
            </tr>
        {{--@endforeach--}}
        </tbody>
    </table>
</div>