<article>
  @include('address._form', ['title' => __('address.titles.admin_name')])

  <section class="row">
    <section class="form-group col-sm-6 {{ $errors->has('warehouse.storage_time') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-alarm"></i></span>
        <input type="number" min="0" name="warehouse[storage_time]" class="form-control" placeholder="Storage Time" name="name"
               value="{{ $warehouse->storage_time or old('warehouse.storage_time') }}">

        @if ($errors->has('warehouse.storage_time'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('warehouse.storage_time') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-6 {{ $errors->has('warehouse.box_price') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
        <input type="number" min="0.00" step="0.01" name="warehouse[box_price]" class="form-control" placeholder="Box price"
               value="{{ $warehouse->box_price or old('warehouse.box_price') }}">
      </div>

      @if ($errors->has('warehouse.box_price'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('warehouse.box_price') }}
          </strong>
        </span>
      @endif
    </section>
  </section>
</article>




