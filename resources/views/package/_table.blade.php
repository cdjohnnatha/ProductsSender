<table id="{{$table_id}}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th class="col-sm-2" data-orderable="false">Picture</th>
    <th class="col-sm-2">Warehouse</th>
    <th class="col-sm-2">Status</th>
    <th data-orderable="false">Obs</th>
    <th>Updated at</th>
    <th data-orderable="false" class="col-xs-2">
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach($packages as $package)
    <tr>
      <td>
        @if(count($package->pictures) > 0)
          <img src="{{$package->pictures[0]->path}}" alt="" class="img-thumbnail" />
        @endif
      </td>
      <td>{{$package->companyWarehouse->name}}</td>
      <td><span class="label label-default">{{$package->packageStatus->message}}</span></td>
      <td>
        {{$package->note}}
        @if(!$package->goodsDeclaration)
          <p class="text-danger">{{__('packages.goods.required_declaration')}}</p>
        @endif
      </td>
      <td>{{Carbon\Carbon::parse($package->updated_at)->format('d/m/Y')}}</td>
      <td>


         <section id="sweet_alerts_card">
          @if($package->goodsDeclaration)
            <a href="#" onclick="window.location='{{Route('user.packages.processPackageWizard', $package->id)}}'" class="icon" data-placement="top" title="{{__('buttons.titles.send_package')}}" data-toggle="tooltip">
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
          @else
             {{--<a href="#" onclick="window.location='{{Route('user.goods.create', $package->id)}}'" class="icon" data-placement="top" title="{{__('buttons.titles.required_custom_clearance')}}" data-toggle="tooltip">--}}
               {{--<i class="zmdi zmdi-assignment"></i>--}}
             {{--</a>--}}
          @endif
          <form action="{{route('user.packages.destroy', $package->id)}}" method="POST"  role="form" id="delete-form-{{$package->id}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
          </form>
        </section>
      </td>

    </tr>
  @endforeach
  </tbody>
</table>