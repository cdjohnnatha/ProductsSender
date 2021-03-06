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
        <a href="{{route('user.notifications.read.show', $notification->id)}}">
          {{$notification->data['message']['header']}}
        </a>
      </td>
      <td class="col-xs-2">{{Carbon\Carbon::parse($notification->created_at)->format('d/m/Y')}}</td>
      <td>
        @if(is_null($notification->read_at))
          <a href="javascript:void(0)" onclick="$('#readForm-{{$notification->id}}').submit();">
            <i class="zmdi zmdi-circle"></i>
          </a>
          <form action="{{route('user.notifications.update', $notification->id)}}" role="form" method="POST" id="readForm-{{$notification->id}}">
            <input name="_method" type="hidden" value="PUT">
            {{ csrf_field() }}
          </form>
        @else
          <i class="zmdi zmdi-circle-o"></i>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>