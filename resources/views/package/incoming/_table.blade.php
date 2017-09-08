<table id="{{$table_id}}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th class="col-sm-1">Id</th>
    <th class="col-sm-2">{{__('common.titles.track_number')}}</th>
    <th class="col-sm-2">Warehouse</th>
    <th data-orderable="false" class="col-xs-2">
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach($incomingPackages as $incoming)
    <tr>
      <td>{{$incoming->id}}</td>
      <td>{{$incoming->registered}}</td>

      {{--<td>{{Carbon\Carbon::parse($package->created_at)->format('d/m/Y')}}</td>--}}
      <td>
        @include('layouts.formButtons._form_all', ['prefix_name' => 'admin.packages' ,'id' => $incoming->id])
      </td>
    </tr>
  @endforeach
  </tbody>
</table>