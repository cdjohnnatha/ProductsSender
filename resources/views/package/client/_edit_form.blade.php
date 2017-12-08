<article>
  <section class="row">
    <div class="form-group col-sm-4 label-floating {{ $errors->has('package.provider') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{ __('packages.user.provider') }}</label>
        <input type="text" class="form-control" name="package[provider]" value="{{ $package->provider or old('package.provider') }}">

        @if ($errors->has('package.provider'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('package.provider') }}
            </strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group col-sm-4 label-floating {{ $errors->has('package.addressee') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{__('packages.user.addressee')}}</label>
        <input type="text" class="form-control" name="package[addressee]" value="{{ $package->addressee or old('package.addressee') }}">

        @if ($errors->has('package.addressee'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('package.addressee') }}
            </strong>
          </span>
        @endif
      </div>
    </div>


    <div class="form-group col-sm-4 label-floating {{ $errors->has('warehouse_id') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        <label class="control-label">{{ __('warehouse.form.select_warehouse') }}</label>
        @include('company.warehouse._select', ['tagName' => 'package[company_warehouse_id]', 'tags' => 'package.company_warehouse_id'])
      </div>
    </div>

  </section>
  <section class="row">
    <section class="form-group col-sm-6 label-floating {{ $errors->has('package.track_number') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-gps-dot"></i></span>
        <label class="control-label">{{ __('packages.user.track_number') }}</label>
        <input type="text" class="form-control" name="package[track_number]"
               value="{{$package->track_number or old('package.track_number')}}">

        @if ($errors->has('package.track_number'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('package.track_number') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-6 label-floating {{ $errors->has('package.track_number') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-tag"></i></span>
        <label class="control-label">{{__('packages.user.package_content')}}</label>

        <select class="select form-control" name="package[content_type]">
          <option value="MERCHANDISE"  {{ old('package.content_type') == 'MERCHANDISE' ? 'selected' : ''}}>Merchandise</option>
          <option value="GIFT" {{ old('package.content_type') == 'GIFT' ? 'selected' : '' }}>Gift</option>
        </select>

        @if ($errors->has('package.content_type'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('package.content_type') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

  </section>

  <section class="row">
    <section class="form-group label-floating {{ $errors->has('package.description') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-comment-edit"></i></span>
        <label class="control-label">{{ __('packages.user.description') }}</label>
        <textarea tabindex="2" class="form-control" name="package[description]">
          {{$package->description or old('package.description')}}
        </textarea>

        @if ($errors->has('package.description'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('package.description') }}
            </strong>
          </span>
        @endif
      </div>
    </section>
  </section>
</article>