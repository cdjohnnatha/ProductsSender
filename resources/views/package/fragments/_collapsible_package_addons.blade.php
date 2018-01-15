<div class="panel-heading" role="tab" id="heading-{{ $index }}">
    <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $index }}"
           aria-expanded="false" aria-controls="collapse-{{ $index }}">
            Package #{{ $package->id }}
        </a>
    </h4>
</div>
<div id="collapse-{{ $index }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-{{ $index }}">
    <div class="panel-body">
        <article>
            <div class="table-responsive border-grey-bottom-1px m-b-20" id="table_checkbox">
                @foreach($warehouses->addons as $addon)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="addons_check" value="{{ $addon->id }}"
                                   count-value="{{ $index }}" data-price="{{ $addon->price }}"
                                   name="package_addons[{{ $index }}][company_warehouse_addon_id][]"
                                    {{ $tags }}
                                <?php
                                    if(isset($package->orderPackage->orderAddons)){
                                        foreach($package->orderPackage->orderAddons as $checkedAddons){
                                            if($checkedAddons->company_warehouse_addon_id == $addon->id){
                                                echo "checked disabled";
                                            }
                                        }
                                } ?>
                            >
                            {{ $addon->companyAddons->title.' - ' }}
                            <small>
                                {{--({{$service->description}}) ---}}
                                <span style="color: black;">@lang('warehouse.addons.price') : </span>
                                <span style="color: #388e3c;">+{{ $addon->price }}</span>
                            </small>
                        </label>
                    </div>
                @endforeach
                    <input type="hidden" id="package_id" value="{{ $package->id }}">
                <div id="price_addons"></div>
            </div>
        </article>
    </div>
</div>