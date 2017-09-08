<article>
  <section class="row">
    <div class="form-group col-sm-8 label-floating {{ $errors->has('service.title') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-assignment-account"></i></span>
        <label class="control-label">{{__('service.form.service_name')}}</label>
        <input type="text" class="form-control" name="service[title]" value="{{$service->title or old('service.title')}}">

        @if ($errors->has('service.title'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('service.title') }}
            </strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group col-sm-4 label-floating {{ $errors->has('service.price') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
        <label class="control-label">{{__('common.titles.price')}}</label>
        <input type="number" min="0.00" step="0.01" class="form-control" name="service[price]" value="{{$service->price or old('service.price')}}">

        @if ($errors->has('service.price'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('service.price') }}
            </strong>
          </span>
        @endif
      </div>
    </div>
  </section>
  <section>
    <div class="form-group label-floating {{ $errors->has('service.description') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-assignment"></i></span>
        <label class="control-label">{{__('common.titles.description')}}</label>
        <textarea  class="form-control" tabindex="2" name="service[description]">
          {{$service->description or old('service.description')}}
        </textarea>

        @if ($errors->has('service.description'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('service.description') }}
            </strong>
          </span>
        @endif
      </div>
    </div>
  </section>
</article>

