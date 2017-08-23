<article>
  <section>
    <ul class="card-actions icons right-top">
      <li class="form-group">
        <label class="control-label">{{__('common.titles.active')}}</label>
        <section class="togglebutton m-b-15 ">
          <label>
            <input type="checkbox" name="active"
                   class="toggle-primary" {{$subscription->active or old('active') ? 'checked' : ''}}
                   value="{{$subscription->active or old('active')}}">
          </label>
        </section>
      </li>
      <li class="form-group">
        <label class="control-label">{{__('common.titles.principal_offer')}}</label>
        <section class="togglebutton m-b-15 ">
          <label>
            <input type="checkbox" name="principal"
                   class="toggle-primary" {{$subscription->principal or old('principal') ? 'checked' : ''}}
                   value="{{$subscription->principal or old('principal')}}">
          </label>
        </section>
      </li>
    </ul>
  </section>

  <section class="row">
    <section class="form-group col-sm-6 label-floating {{ $errors->has('subscription.title') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{__('plans.form.name')}}</label>
        <input type="text" class="form-control" name="subscription[title]"
               value="{{$subscription->title or old('subscription.title')}}">

        @if ($errors->has('subscription.title'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('subscription.title') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-3 label-floating {{ $errors->has('subscription.amount') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
        <label class="control-label">{{__('common.titles.price')}}</label>
        <input type="number" min="0.00" step="0.01" class="form-control" name="subscription[amount]"
               value="{{$subscription->amount or old('subscription.amount')}}">

        @if ($errors->has('subscription.amount'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('subscription.amount') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-3 label-floating">
      <div class="input-group">
        <label class="control-label">{{__('common.titles.period')}}</label>
        <select class="select form-control" name="subscription[period]">
          <option value="0">{{__('common.calendar.month')}}</option>
          <option value="1">{{__('common.calendar.year')}}</option>
        </select>
      </div>
    </section>
  </section>

  <section class="{{ $errors->has('subscription.amount') ? ' has-error' : '' }}">
    <div>
      @if(Request::is('*/edit'))
        <nested-messages :editing="{{$subscription->benefits}}"></nested-messages>
      @else
        <nested-messages></nested-messages>
      @endif

      @if ($errors->has('subscription.amount'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('subscription.amount') }}
          </strong>
        </span>
      @endif
    </div>
  </section>

</article>



