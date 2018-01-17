<div class="card">
    <div class="panel-heading" role="tab" id="heading-{{ $index }}">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $index }}"
               aria-expanded="false" aria-controls="collapse-{{ $index }}">
                Package #{{ $package->id }}
            </a>
        </h4>
    </div>
    <div id="collapse-{{ $index }}" class="panel-collapse collapse in" role="tabpanel"
         aria-labelledby="heading-{{ $index }}">
        <div class="panel-body">
            <article>
                <div class="table-responsive border-grey-bottom-1px m-b-20" id="table_checkbox">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Amount $</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="3">Shipment</th>
                                </tr>
                                <tr>
                                    <td>Shipment</td>
                                    <td>{{ $order_fowards->price }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">Addons</th>
                                </tr>
                                @foreach($order_addons as $addon)
                                    <tr>
                                        <td>{{ $addon->companyWarehouseAddon->companyAddons->title }}</td>
                                        <td>{{ $addon->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" id="package_id" value="{{ $package->id }}">
                        <div id="price_addons"></div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>