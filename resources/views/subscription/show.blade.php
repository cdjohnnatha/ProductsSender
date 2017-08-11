<link href="{{asset('css/plans.css')}}" rel="stylesheet">

<section id="lists">
  <div class="columns">
    <ul class="price">
      <li class="header">{{$subscription->title}}</li>
      <li class="grey">$ {{$subscription->amount}} / month</li>
      @foreach($subscription->benefits as $benefit)
        <li>{{$benefit->message}}</li>
      @endforeach
    </ul>
  </div>
</section>
