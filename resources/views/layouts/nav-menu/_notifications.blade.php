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
          <a href="{{route('user.notifications.mark.all')}}">
            <i class="zmdi zmdi-check-all"></i>
          </a>
        </li>
      </ul>
    </li>
    @if(auth()->guard('web')->user())
      <user-notifications :data_id="{{Auth::user()->id}}"></user-notifications>
    @else
      <warehouse-notifications :data_id="{{Auth::user()->warehouse_id}}"></warehouse-notifications>
    @endif
    <li class="dropdown-menu-footer">
      <a href="{{route('user.notifications.index')}}">
        All notifications
      </a>
    </li>
  </ul>
</li>