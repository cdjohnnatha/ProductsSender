<article>
  <section class="row">


    <div class="form-group col-sm-4 label-floating {{ $errors->has('incoming.provider') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{__('packages.incoming.form.provider')}}</label>
        <input type="text" class="form-control" name="incoming[provider]" value="{{$incoming->provider or old('incoming.provider')}}">

        @if ($errors->has('incoming.provider'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('incoming.provider') }}
            </strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group col-sm-4 label-floating {{ $errors->has('incoming.addressee') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{__('packages.incoming.form.addressee')}}</label>
        <input type="text" class="form-control" name="incoming[addressee]" value="{{$incoming->addressee or old('incoming.addressee')}}">

        @if ($errors->has('incoming.addressee'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('incoming.addressee') }}
            </strong>
          </span>
        @endif
      </div>
    </div>


    <div class="form-group col-sm-4 label-floating {{ $errors->has('warehouse_id') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        <label class="control-label">{{__('warehouse.form.select_warehouse')}}</label>
        @include('company_warehouse._select')
      </div>
    </div>

  </section>
  <section class="row">
    <section class="form-group col-sm-6 label-floating {{ $errors->has('incoming.track_number') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-gps-dot"></i></span>
        <label class="control-label">{{__('packages.incoming.form.track_number')}}</label>
        <input type="text" class="form-control" name="incoming[track_number]"
               value="{{$incoming->track_number or old('incoming.track_number')}}">

        @if ($errors->has('incoming.track_number'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('incoming.track_number') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-6 label-floating {{ $errors->has('incoming.track_number') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-tag"></i></span>
        <label class="control-label">{{__('packages.incoming.form.package_content')}}</label>

        <select class="select form-control" name="incoming[content_type]">
          <option value="0"  {{old('incoming.content_type')}}>Merchandise</option>
          <option value="1" {{old('incoming.content_type')}}>Gift</option>
        </select>

        @if ($errors->has('incoming.content_type'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('incoming.content_type') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

  </section>

  <section class="row">
    <section class="form-group label-floating {{ $errors->has('incoming.description') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-comment-edit"></i></span>
        <label class="control-label">{{__('common.titles.description')}}</label>
        <textarea tabindex="2" class="form-control" name="incoming[description]">
          {{$incoming->description or old('incoming.description')}}
        </textarea>

        @if ($errors->has('incoming.description'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('incoming.description') }}
            </strong>
          </span>
        @endif
      </div>
    </section>
  </section>
</article>