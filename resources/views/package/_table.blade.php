<table id="{{$table_id}}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th class="col-sm-1">Id</th>
    <th class="col-sm-2">Picture</th>
    <th class="col-sm-2">Warehouse</th>
    <th class="col-sm-2">Status</th>
    <th>Obs</th>
    <th>Arrival date</th>
    <th data-orderable="false" class="col-xs-2">
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach($packages as $package)
    <tr>
      <td>{{$package->id}}</td>
      <td>
        @if(count($package->pictures) > 0)
          <img src="{{$package->pictures[0]->path}}" alt="" class="img-thumbnail" />
        @endif
      </td>
      <td>{{$package->warehouse->address->label}}</td>
      <td><span class="label label-default">{{$package->status->status}}</span></td>
      <td>{{$package->note}}</td>
      <td>{{Carbon\Carbon::parse($package->created_at)->format('d/m/Y')}}</td>
      <td>
        @if(auth()->guard('admin')->user())
          @include('layouts.formButtons._form_all', ['prefix_name' => 'admin.packages' ,'id' => $package->id])
        @else
          @include('layouts.formButtons._form_show_delete', ['prefix_name' => 'user.packages' ,'id' => $package->id])
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>