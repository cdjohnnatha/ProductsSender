<li class="dropdown hidden-xs hidden-sm">
  <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
    <span class="badge mini" id="notification_span"></span>
    <i class="zmdi zmdi-notifications"></i>
  </a>
  <ul class="dropdown-menu dropdown-lg-menu dropdown-menu-right dropdown-alt">
    <li class="dropdown-menu-header">
      <ul class="card-actions icons  left-top">
        <li class="withoutripple">
          <a href="javascript:void(0)" class="withoutripple">
            <i class="zmdi zmdi-settings"></i>
          </a>
        </li>
      </ul>
      <h5>NOTIFICATIONS</h5>
      <ul class="card-actions icons right-top">
        <li>
          <a href="javascript:void(0)">
            <i class="zmdi zmdi-check-all"></i>
          </a>
        </li>
      </ul>
    </li>
    <user-notifications :data_id="{{Auth::user()->id}}"></user-notifications>

      {{--<li>--}}
        {{--<div class="card">--}}
          {{--<a href="javascript:void(0)" class="pull-right dismiss" data-dismiss="close">--}}
            {{--<i class="zmdi zmdi-close"></i>--}}
          {{--</a>--}}
          {{--<div class="card-body">--}}
            {{--<ul class="list-group ">--}}
              {{--<li class="list-group-item ">--}}
                {{--<span class="pull-left"><img src="{{asset('img/profiles/11.jpg')}}" alt="" class="img-circle max-w-40 m-r-10 "></span>--}}
                {{--<div class="list-group-item-body">--}}
                  {{--<div class="list-group-item-heading">Dakota Johnson</div>--}}
                  {{--<div class="list-group-item-text">Do you want to grab some sushi for lunch?</div>--}}
                {{--</div>--}}
              {{--</li>--}}
            {{--</ul>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</li>--}}
      {{--<li>--}}
        {{--<div class="card">--}}
          {{--<a href="javascript:void(0)" class="pull-right dismiss" data-dismiss="close">--}}
            {{--<i class="zmdi zmdi-close"></i>--}}
          {{--</a>--}}
          {{--<div class="card-body">--}}
            {{--<ul class="list-group ">--}}
              {{--<li class="list-group-item ">--}}
                {{--<span class="pull-left"><img src="{{asset('img/profiles/07.jpg')}}" alt="" class="img-circle max-w-40 m-r-10 "></span>--}}
                {{--<div class="list-group-item-body">--}}
                  {{--<div class="list-group-item-heading">Todd Cook</div>--}}
                  {{--<div class="list-group-item-text">Let's schedule a meeting with our design team at 10am.</div>--}}
                {{--</div>--}}
              {{--</li>--}}
            {{--</ul>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</li>--}}
      {{--<li>--}}
        {{--<div class="card">--}}
          {{--<a href="javascript:void(0)" class="pull-right dismiss" data-dismiss="close">--}}
            {{--<i class="zmdi zmdi-close"></i>--}}
          {{--</a>--}}
          {{--<div class="card-body">--}}
            {{--<ul class="list-group ">--}}
              {{--<li class="list-group-item ">--}}
                {{--<span class="pull-left"><img src="{{asset('img/profiles/05.jpg')}}" alt="" class="img-circle max-w-40 m-r-10 "></span>--}}
                {{--<div class="list-group-item-body">--}}
                  {{--<div class="list-group-item-heading">Jennifer Ross</div>--}}
                  {{--<div class="list-group-item-text">We're looking to hire two more protypers to our team.</div>--}}
                {{--</div>--}}
              {{--</li>--}}
            {{--</ul>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</li>--}}
      {{--<li>--}}
        {{--<div class="card">--}}
          {{--<a href="javascript:void(0)" class="pull-right dismiss" data-dismiss="close">--}}
            {{--<i class="zmdi zmdi-close"></i>--}}
          {{--</a>--}}
          {{--<div class="card-body">--}}
            {{--<ul class="list-group ">--}}
              {{--<li class="list-group-item ">--}}
                {{--<span class="pull-left"><img src="{{asset('img/profiles/07.jpg')}}" alt="" class="img-circle max-w-40 m-r-10 "></span>--}}
                {{--<div class="list-group-item-body">--}}
                  {{--<div class="list-group-item-heading">Todd Cook</div>--}}
                  {{--<div class="list-group-item-text">Let's schedule a meeting with our design team at 10am.</div>--}}
                {{--</div>--}}
              {{--</li>--}}
            {{--</ul>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</li>--}}
    <li class="dropdown-menu-footer">
      <a href="javascript:void(0)">
        All notifications
      </a>
    </li>
  </ul>
</li>