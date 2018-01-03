<div id="content" class="container">
    <div class="row">
        <div class="{{ Route::is('user.single_package.create.selected ') ? 'col-xs-12' : 'col-xs-10' }}">
            <div class="card-body p-50 p-t-10 invoice">
                <div class="row">
                    <div class="col-xs-6">
                        <h3>@lang('packages.show.warehouse')</h3>
                        <address class="address">
                            {{ $package->companyWarehouse->name }}<br>
                            {{ $package->companyWarehouse->address->formatted_address }}<br>
                            {{ $package->companyWarehouse->address->postal_code }}<br>
                            {{ __('common.titles.phone').': ' }}<br>
                            @foreach($package->companyWarehouse->phones as $phones)
                                {{ $phones->number . ' / ' }}
                            @endforeach
                        </address>
                    </div>
                    <div class="col-xs-6">
                        <h3>@lang('packages.show.destiny_address')</h3>
                        <address class="address">
                            {{ $package->companyWarehouse->name }}<br>
                            {{ $package->companyWarehouse->address->formatted_address }}<br>
                            {{ $package->companyWarehouse->address->postal_code }}<br>
                            {{ __('common.titles.phone').': ' }}<br>
                            @foreach($package->companyWarehouse->phones as $phones)
                                {{ $phones->number . ' / ' }}
                            @endforeach
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>