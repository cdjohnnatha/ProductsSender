<article>
  <section class="row">
    <section class="form-group col-sm-8 label-floating {{ $errors->has('subscription.title') ? ' has-error' : '' }}">
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

    <section class="form-group col-sm-4 label-floating {{ $errors->has('subscription.amount') ? ' has-error' : '' }}">
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
  </section>

  <section class="form-group label-floating {{ $errors->has('subscription.amount') ? ' has-error' : '' }}">
    <div class="input-group">
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



