<section id="plan_section">
  <header class="col-xs-12 col-sm-8 col-sm-offset-2">
    <div class="card"  id="packages">
      <header class="card-heading ">
        <h2 class="card-title text-green">{{__('user.registration.plans_title')}}</h2>
      </header>
      @if(count($subscriptions_active_year) > 0)
        <div class="card-body">
          <p>{{__('plans.index.short_title_1')}}</p>
          <p>{{__('plans.index.short_title_2')}}</p>
            <div class="togglebutton m-t-20 ">
              <label>
                <input type="checkbox" class="toggle-success" id="toggle-price"> {{__('plans.index.switch_anual_title')}}
              </label>
          </div>
        </div>
      @endif
    </div>
  </header>

  <section class="col-xs-11">

    <div class="pricing-wrapper" style="margin-bottom: 0;">
      <div class="row">
        {{--Card #1--}}
        @foreach($subscriptions_active_month as $subscription)
          <div class="col-sm-4 container-card-front" style="z-index: 1;">
            <div class="card-container">
              <div class="card card-flip pricing-card">
                <section class="card-front {{$subscription->principal ? 'feature-pricing-card' : ''}}" style="height: 34em;">
                  <div class="card-heading" style="padding-top: 25px;">
                    <div class="card-title">
                      <h1>
                        <sup>$</sup>
                        @if($subscription->amount == 0)
                          Free
                        @else
                          {{$subscription->amount}}
                        @endif
                      </h1>
                      <span class="pricing-period">/ month</span>
                      <span class="pricing-title {{$subscription->principal ? 'text-red' : 'text-blue'}}">
                      {{$subscription->title}}
                      </span>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="pricing-feature-list" style="padding-bottom: 0;">
                      <li class="pricing-feature">Slots: {{$subscription->slots}}</li>
                      <li class="pricing-feature">Discounts in our services: {{$subscription->discounts}}</li>
                      @foreach($subscription->benefits as $benefit)
                        <li class="pricing-feature">{{$benefit->message or ''}}</li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="card-footer text-center" style="padding-top: 0;">
                    <button class="btn {{$subscription->principal ? 'btn-primary' : 'btn-info '}} btn-round planSection"
                        id="{{$subscription->id}}">
                      Choose plan
                    </button>
                  </div>
                </section>
              </div>
            </div>
          </div>
        @endforeach
          {{--End Card 1--}}
        {{--BEGIN CARD BACK--}}
        @foreach($subscriptions_active_year as $per_year)
          <div class="col-sm-4">
            <div class="card-container">
              <div class="card card-flip pricing-card">
                <section class="card-back" style="height: 34em;">
                  <div class="card-heading" style="padding-top: 25px;">
                    <div class="card-title">
                      <h1>
                        <sup>$</sup>
                        @if($per_year->amount == 0)
                          Free
                        @else
                          {{$per_year->amount}}
                        @endif
                      </h1>
                      <span class="pricing-period">/ year</span>
                      <span class="pricing-title {{$per_year->principal ? 'text-red' : 'text-blue'}}">
                      {{$per_year->title}}
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="pricing-feature-list" style="padding-bottom: 0;">
                      <li class="pricing-feature">Slots: {{$subscription->slots}}</li>
                      <li class="pricing-feature">Discounts in our services: {{$subscription->discounts}}</li>
                      @foreach($per_year->benefits as $benefit)
                        <li class="pricing-feature">{{$benefit->message or ''}}</li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="card-footer text-center" style="padding-top: 0;">
                    <button class="btn {{$per_year->principal ? 'btn-primary' : 'btn-info '}} btn-round planSection"
                            id="{{$per_year->id}}">
                      Choose plan</button>
                  </div>
                </section>
              </div>
            </div>
          </div>
        @endforeach
        </div>
    </div>
  </section>
</section>

@section('footerJS')
  <script>
      $('.planSection').click(function(){
          let plan = $('#plan_section').addClass('hidden');
          var id = $(this).attr('id');
          $('#subscription_id').val(id);
          $('#registration_content').removeClass('hidden');
      });
      $('#content_outer_wrapper').css('padding-left', '0').addClass('col-sm-offset-1');
  </script>
@endsection