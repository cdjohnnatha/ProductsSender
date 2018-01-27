<section class="nav-wrapper">
  <ul class="nav navbar-nav pull-left left-menu">
    <li class="app_menu-open">
      <a href="javascript:void(0)" data-toggle-state="app_sidebar-left-open" data-key="leftSideBar">
        <i class="zmdi zmdi-menu"></i>
      </a>
    </li>
  </ul>
  @if(auth()->user()->type == 'user')
    <ul class="nav navbar-nav left-menu hidden-xs">
      <li>
        <span>
          <a href="{{ route('user.payment_transactions.index') }}">
            <i class="zmdi zmdi-balance-wallet zmdi-2x">
              <?php if(is_null(Auth::user()->client->walletResult())){
                  echo "0.00";
                } else{
                  echo Auth::user()->client->walletResult();
                } ?>
            </i>
          </a>
        </span>
      </li>
    </ul>
  @endif
  <ul class="nav navbar-nav pull-right">
    <li class="dropdown avatar-menu">
      <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
        <span class="meta">
            <span class="avatar">
                <img src="{{asset('img/logo/holyship-circle.png')}}" alt="" class="img-circle max-w-35">
                <i class="badge mini success status"></i>
            </span>
            <span class="name">{{ Auth::user()->name }}</span>
            <span class="caret"></span>
        </span>
      </a>
      <ul class="dropdown-menu btn-primary dropdown-menu-right">
        <li>
          @if(auth()->user()->type == 'user')
            <a href="{{ route('user.clients.show', Auth::user()->client->id) }}"><i class="zmdi zmdi-account"></i> @lang('user.profile')</a>
          @else
            <a href=""><i class="zmdi zmdi-account"></i> @lang('user.profile')</a>
          @endif
        </li>
        <li>
          <a href="javascript:void(0)"><i class="zmdi zmdi-settings"></i> Account Settings</a>
        </li>
        <li>
          <a href="{{Route('logout')}}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            <i class="zmdi zmdi-sign-in"></i> Sign Out
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              {{ csrf_field() }}
            </form>
          </a>
        </li>
      </ul>
    </li>
    <li class="select-menu hidden-xs hidden-sm">
      <select class="select form-control country" style="display:none">
        <option option="EN" value="en">English</option>
        <option option="BR" value="br">Português</option>
      </select>
    </li>
    @include('layouts.nav-menu._notifications')
  </ul>
</section>

@section('footerJS')
  <script>
      $('.country').on('change', function(){
        window.location = '/locale/' + $(this).val();
      });
  </script>
@endsection