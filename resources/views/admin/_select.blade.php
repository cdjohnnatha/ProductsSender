<section>
  <label class="control-label">{{__('warehouse.form.warehouse_in_charge')}}</label>
    <select class="form-control" name="admin_id">
      @foreach($admins as $admin)
        <option value="{{$admin->id or old('admin_id')}}">
            {{$admin->name.' '.$admin->surname}}
        </option>
      @endforeach
    </select>
</section>
