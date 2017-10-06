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
           <section id="sweet_alerts_card">

            <a href="#" onclick="window.location='{{Route('user.single_package.create.selected', $package->id)}}'" class="icon" data-placement="top" title="{{__('buttons.titles.send_package')}}" data-toggle="tooltip">
              <i class="zmdi zmdi-mail-send"></i>
            </a>

            <a href="#" class="icon" onclick="window.location='{{Route("user.packages.show", $package->id)}}'" data-toggle="tooltip"
               data-placement="top" title="{{__('buttons.titles.show')}}">
              <i class="zmdi zmdi-search"></i>
            </a>

            <a href="javascript:void(0)" class="icon alerting-delete" id="delete-button-{{$package->id}}" formSubmitId="delete-form-{{$package->id}}"
               data-toggle="tooltip" data-placement="top" title="{{__('buttons.titles.delete')}}">
              <i class="zmdi zmdi-delete"></i>
            </a>
            <form action="{{route('user.packages.destroy', $package->id)}}" method="POST"  role="form" id="delete-form-{{$package->id}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
            </form>
          </section>
        @endif
      </td>

    </tr>
  @endforeach
  </tbody>
</table>