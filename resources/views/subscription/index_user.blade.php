<header class="col-xs-12 col-sm-8 col-sm-offset-2">
  <div class="card"  id="packages">
    <header class="card-heading ">
      <h2 class="card-title text-green">{{__('user.registration.plans_title')}}</h2>
    </header>
    <div class="card-body">
      <p>Every paid plan starts with a 14-day free trial.<br>
        No credit card required, no strings attached.</p>
        <div class="togglebutton m-t-20 ">
          <label>
            <input type="checkbox" class="toggle-success" id="toggle-price"> Switch to Annual &amp; Save 20% off.
          </label>
      </div>
    </div>
  </div>
</header>

<section class="col-xs-12">

  <div class="pricing-wrapper" style="margin-bottom: 0;">
    <div class="row">
      {{--Card #1--}}
      <div class="col-md-4">
        <div class="card-container">
          <div class="card card-flip pricing-card">
            <section class="card-front">
              <div class="card-heading">
                <div class="card-title">
                  <h1><sup>$</sup>30</h1>
                  <span class="pricing-period">/ month</span>
                  <span class="pricing-title text-blue">Startup</span>
                </div>
              </div>
              <div class="card-body">
                <ul class="pricing-feature-list">
                  <li class="pricing-feature">1 GB of space</li>
                  <li class="pricing-feature">Support at $25/hour</li>
                  <li class="pricing-feature">Limited cloud access</li>
                </ul>
              </div>
              <div class="card-footer text-center">
                <button class="btn btn-info btn-round">Choose plan</button>
              </div>
            </section>
            <section class="card-back">
              <div class="card-heading">
                <div class="card-title">
                  <h1><sup>$</sup>288</h1>
                  <span class="pricing-period">/ year</span>
                  <span class="pricing-title text-blue">Startup</span>
                </div>
              </div>
              <div class="card-body">
                <ul class="pricing-feature-list">
                  <li class="pricing-feature">1 GB of space</li>
                  <li class="pricing-feature">Support at $25/hour</li>
                  <li class="pricing-feature">Limited cloud access</li>
                </ul>
              </div>
              <div class="card-footer text-center">
                <button class="btn btn-info btn-round">Choose plan</button>
              </div>
            </section>
          </div>
        </div>
      </div>
      {{--End Card 1--}}


      {{--Principal card--}}
      {{--<div class="col-md-4">--}}
        {{--<div class="card-container">--}}
          {{--<div class="card card-flip pricing-card">--}}
            {{--<section class="card-front feature-pricing-card">--}}
              {{--<div class="card-heading">--}}
                {{--<div class="card-title">--}}
                  {{--<h1><sup>$</sup>60</h1>--}}
                  {{--<span class="pricing-period">/ month</span>--}}
                  {{--<span class="pricing-title text-red">Business</span>--}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="card-body">--}}
                {{--<ul class="pricing-feature-list">--}}
                  {{--<li class="pricing-feature">5 GB of space</li>--}}
                  {{--<li class="pricing-feature">Support at $5/hour</li>--}}
                  {{--<li class="pricing-feature">Full cloud access</li>--}}
                {{--</ul>--}}
              {{--</div>--}}
              {{--<div class="card-footer text-center">--}}
                {{--<button class="btn btn-primary btn-round">Choose plan</button>--}}
              {{--</div>--}}
            {{--</section>--}}
            {{--<section class="card-back feature-pricing-card">--}}
              {{--<div class="card-heading">--}}
                {{--<div class="card-title">--}}
                  {{--<h1><sup>$</sup>576</h1>--}}
                  {{--<span class="pricing-period">/ year</span>--}}
                  {{--<span class="pricing-title text-red">Business</span>--}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="card-body">--}}
                {{--<ul class="pricing-feature-list">--}}
                  {{--<li class="pricing-feature">5 GB of space</li>--}}
                  {{--<li class="pricing-feature">Support at $5/hour</li>--}}
                  {{--<li class="pricing-feature">Full cloud access</li>--}}
                {{--</ul>--}}
              {{--</div>--}}
              {{--<div class="card-footer text-center">--}}
                {{--<button class="btn btn-primary btn-round">Choose plan</button>--}}
              {{--</div>--}}
            {{--</section>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</div>--}}
      {{--End principal card--}}

    </div>
  </div>
</section>