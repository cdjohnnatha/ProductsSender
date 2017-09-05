<table id="{{$table_id}}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th class="col-sm-1">{{__('common.titles.message')}}</th>
    <th class="col-sm-2">{{__('common.calendar.date')}}</th>
    <th data-orderable="false" class="col-sm-2">{{__('notification.titles.mark_read')}}</th>
  </tr>
  </thead>
  <tbody>
  @foreach($notifications as $notification)
    <tr>
      <td class="col-xs-7">
        <a href="{{route('user.packages.show', $notification->data['package'])}}">
          {{$notification->data['message']['header']}}
        </a>
      </td>
      <td class="col-xs-2">{{Carbon\Carbon::parse($notification->created_at)->format('d/m/Y')}}</td>
      <td>
        @if(is_null($notification->read_at))
          <a href=""><i class="zmdi zmdi-circle"></i></a>
        @else
          <i class="zmdi zmdi-circle-o"></i>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>