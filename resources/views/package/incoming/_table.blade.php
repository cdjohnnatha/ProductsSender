<table id="{{$table_id}}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th class="col-sm-1">Id</th>
    <th class="col-sm-1">{{__('common.titles.status')}}</th>
    <th class="col-sm-2">{{__('common.titles.track_number')}}</th>
    <th class="col-sm-2">{{__('common.titles.warehouse')}}</th>
    <th class="col-sm-2">{{__('common.titles.provider')}}</th>
    <th class="col-sm-2">{{__('address.titles.addressee')}}</th>
    <th class="col-sm-2">{{__('common.calendar.created_at')}}</th>
    <th data-orderable="false" class="col-xs-2">
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach($incomingPackages as $incoming)
    <tr>
      <td>{{$incoming->id}}</td>
      <td>{{$incoming->registered ? __('common.status.registered') : __('common.status.unregistered')}}</td>
      <td>{{$incoming->track_number}}</td>
      <td>{{$incoming->warehouse->address->label}}</td>
      <td>{{$incoming->provider}}</td>
      <td>{{$incoming->addressee}}</td>
      <td>{{Carbon\Carbon::parse($incoming->created_at)->format('d/m/Y')}}</td>
      <td>
        <section>
          <a href="#" class="icon" onclick="window.location=''" data-toggle="tooltip"
             data-placement="top" title="{{__('buttons.titles.register')}}">
            <i class="zmdi zmdi-assignment-check"></i>
          </a>
          @include('layouts.formButtons._form_all', ['prefix_name' => 'admin.incoming' ,'id' => $incoming->id])
        </section>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>