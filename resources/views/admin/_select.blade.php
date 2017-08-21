<section>
    <select class="form-control" name="admin_id">
        <option value="">Person in Charge</option>
      @foreach($admins as $admin)
        <option value="{{$admin->id or old('admin_id')}}">
            {{$admin->name.' '.$admin->surname}}
        </option>
      @endforeach
    </select>
    @if ($errors->has('admin_id'))
    <span class="help-block">
        <strong class="text-danger" class="alert-danger">
          It's necessary select one manager
        </strong>
      </span>
    @endif
</section>
