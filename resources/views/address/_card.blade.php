<div class="col-lg-4">
  <div class="card">
    <header class="card-heading {{$default ? 'card-yellow' : 'card-default'}}">
      <h2 class="card-title">
        @if($address->default_address)
          <i class="zmdi zmdi-star"></i>
        @endif
        {{$address->label}}
      </h2>
    </header>
    <div class="card-body">
      <h3>{{$address->owner_name.' '.$address->owner_surname}}</h3>
      <small class="dataTables_info">{{__('address.titles.phone').': '.$address->phone}}</small>
      <p>{{$address->formatted_address}}
        <small class="dataTables_info">, nº {{$address->number.', '.__('address.titles.postal_code').': '. $address->postal_code}}</small></p>
    </div>
    <footer class="card-footer border-top">
      <ul class="card-actions left-bottom">
        <li>
          <a href="javascript:void(0)" class="btn btn-flat {{ $default ? 'btn-default' : 'btn-info'}}"
            {{$default ? 'disabled' : ''}} onclick="$('#form-makedefault-{{$address->id}}').submit();">
            <i class="zmdi {{$default ? 'zmdi-star' : 'zmdi-star-border'}}"></i> Make default
          </a>
          <form action="{{ Route('user.addresses.default', $address->id) }}"
                role="form" method="POST" id="form-makedefault-{{$address->id}}">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
      <ul class="card-actions icons right-bottom">
        <li>
          @include('layouts.formButtons._form_edit_delete', ['prefix_name' => 'user.addresses', 'id' => $address->id])
        </li>
      </ul>
    </footer>
  </div>
</div>