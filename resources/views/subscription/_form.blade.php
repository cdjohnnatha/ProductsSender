
<section class="form-group col-sm-9" {{ $errors->has('subscription.title') ? ' has-error' : '' }}>
        <label>Give a name for a plan</label>
        <input name="subscription[title]" class="form-control"
               value="{{$subscription->title or old('subscription.title')}}">
        @if ($errors->has('subscription.title'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('subscription.title') }}</strong>
        </span>
        @endif
</section>
<section class="form-group col-sm-3" {{ $errors->has('subscription.amount') ? ' has-error' : '' }} >
        <label>Price</label>
        <input name="subscription[amount]" class="form-control" type="number" min="0.00" step="0.01"
               value="{{$subscription->amount or old('subscription.amount')}}">
        @if ($errors->has('subscription.amount'))
                <span class="help-block">
          <strong class="text-danger">{{ $errors->first('subscription.amount') }}</strong>
        </span>
        @endif
</section>
<section>
        @if(Request::is('*/edit'))
            <nested-messages :editing="{{$subscription->benefits}}"></nested-messages>
        @else
            <nested-messages></nested-messages>
        @endif
</section>

