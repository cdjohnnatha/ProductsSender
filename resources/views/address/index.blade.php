@extends('layouts.app')


@section('panel_header')
  {{__('common.titles.address')}}
@endsection

@section('content')
  <section class="card">
    <header class="card-body p-0">
      <div class="tabpanel">
        <ul class="nav nav-tabs nav-tabs-right">
          <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">{{__('common.titles.address')}}</a></li>
          <li role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('common.titles.warehouse')}}</a></li>
        </ul>
      </div>
    </header>

    <section class="tab-content  p-20">
      <section class="tab-pane fadeIn active" id="tab-1">
        <div class="row">
          <div class="card-body p-0">
            @foreach($morph->address as $address)
              <div class="col-lg-4">
                <div class="card">
                  <header class="card-heading {{$address->default_address ? 'card-yellow' : 'card-default'}}">
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
                        <a href="javascript:void(0)" class="btn btn-flat {{$address->default_address ? 'btn-default disabled' : 'btn-info'}}"
                          onclick="$('#form-makedefault-{{$address->id}}').submit();">
                          <i class="zmdi {{$address->default_address ? 'zmdi-star' : 'zmdi-star-border'}}"></i> Make default
                        </a>
                        <form action="{{Route('user.address.default', $address->id)}}"
                              role="form" method="POST" id="form-makedefault-{{$address->id}}">
                          {{ csrf_field() }}
                        </form>
                      </li>
                    </ul>
                    <ul class="card-actions icons right-bottom">
                      <li>
                        @include('layouts.formButtons._form_edit_delete', ['prefix_name' => 'user.address', 'id' => $address->id])
                      </li>
                    </ul>
                  </footer>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
      <section class="tab-pane fadeIn" id="tab-2">

      </section>
    </section>
@endsection

