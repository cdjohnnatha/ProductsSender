
<section class="form-group col-sm-9" {{ $errors->has('title') ? ' has-error' : '' }}>
        <label>Title for Subscription</label>
        <input name="subscription[title]" class="form-control"
               value="{{$subscription->title or old('title')}}">
        @if ($errors->has('title'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('title') }}</strong>
        </span>
        @endif
</section>
<section class="form-group col-sm-3" {{ $errors->has('amount') ? ' has-error' : '' }} >
        <label>Price</label>
        <input name="subscription[amount]" class="form-control" type="number"
               value="{{$subscription->amount or old('amount')}}">
        @if ($errors->has('amount'))
                <span class="help-block">
          <strong class="text-danger">{{ $errors->first('amount') }}</strong>
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

