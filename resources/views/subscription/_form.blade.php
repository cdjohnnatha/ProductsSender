<article>
  <section class="row">
    <section class="form-group col-sm-6 label-floating {{ $errors->has('title') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-card-membership"></i></span>
        <label class="control-label">{{__('plans.form.name')}}</label>
        <input type="text" class="form-control" name="subscription[title]"
               value="{{$subscription->title or old('title')}}">

        @if ($errors->has('title'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('title') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-3 label-floating {{ $errors->has('subscription.amount') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-money-box"></i></span>
        <label class="control-label">{{__('common.titles.amount')}}</label>
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

    <section class="form-group col-sm-3 label-floating {{ $errors->has('subscription.period') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
        <label class="control-label">{{__('common.titles.period')}}</label>
        <select name="subscription[period]" class="select form-control">
          <option value="0">{{__('common.calendar.month')}}</option>
          <option value="1">{{__('common.calendar.year')}}</option>
        </select>
        @if ($errors->has('subscription.period'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('subscription.period') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

  </section>
  <section class="row">
    <section class="form-group col-sm-6 label-floating {{ $errors->has('subscription.discounts') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
        <label class="control-label" for="discounts">{{__('plans.form.discounts')}}</label>
        <input type="number" min="0.00" step="0.01" name="subscription[discounts]" id="discounts" class="form-control"
            value="{{$subscription->discounts or old('subscription.discounts')}}">

        @if ($errors->has('subscription.discounts'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('subscription.discounts') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-6 label-floating {{ $errors->has('subscription.slots') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-view-module"></i></span>
        <label class="control-label" for="slots">{{__('plans.form.slot_quantity')}}</label>
        <input type="number" min="0" step="1" name="subscription[slots]" id="slots" class="form-control"
               value="{{$subscription->slots or old('subscription.slots')}}">

        @if ($errors->has('subscription.slots'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('subscription.slots') }}
            </strong>
          </span>
        @endif
      </div>

    </section>

  </section>
  <section class="row">
    @for($count = 0; $count < 6; $count++)
      <section class="form-group col-sm-6 label-floating {{ $errors->has('benefits') ? ' has-error' : '' }}">
        <div class="input-group">
          <span class="input-group-addon"><i class="zmdi zmdi-star-outline"></i></span>
          <label class="control-label">{{__('plans.subscription.benefits')}}</label>
          <input type="text" class="form-control" name="benefits[{{$count}}][message]" id="benefit-{{$count}}"
                 value="{{$subscription->benefits[$count]->message or old('benefits')}}" required>
          @if(Request::is('*/edit'))
            <input type="hidden" value="{{$subscription->benefits[$count]->id}}" name="benefits[{{$count}}][id]">
            <div class="togglebutton m-b-15">
              <label>Active</label>
              <label>
                <input type="checkbox" class="toggle-info" name="benefits[{{$count}}][active]" value="1"
                  {{$subscription->benefits[$count]->active ? 'checked' : ''}}>
              </label>
            </div>
          @else
            <div class="togglebutton m-b-15">
              <label>Active</label>
              <label>
                <input type="checkbox" name="benefits[{{$count}}][active]" class="toggle-info" value="1" checked>
              </label>
            </div>
          @endif
          @if ($errors->has('benefits'))
            <span class="help-block">
                <strong class="text-danger" class="alert-danger">
                  {{ $errors->first('benefits') }}
                </strong>
              </span>
          @endif
        </div>
      </section>
      @endfor
  </section>

  <section class="col-sm-12">
    <div class="form-group">
      <div class="input-group">
        <label>Services</label><br>
        <small><mark>{{__('plans.form.description_services_title')}}</mark></small>
        @include('service._checkbox', ['services' => $services])
      </div>
    </div>
  </section>


</article>



