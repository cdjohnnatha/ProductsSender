@extends('layouts.app')

@section('content')
 <table class="table table-hover">
    <thead>
    <tr>
        <th>Your Notifications</th>
    </tr>
    <tr>
      <th>Date</th>
      <th>Message</th>
      <th>Package #</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($unreadNotifications as $unread)
        <tr class="success">
          <th>Changed at {{$unread->created_at}}</th>
          <th>{{$unread->data['message']}}</th>
          <th># {{$unread->data['package']['id']}}</th>
            <td>
                <form action="{{route('user.notifications.destroy',
                    [Auth::user()->id, $unread->id])}}" method="POST"  role="form">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-info">
                        <span class="glyphicon glyphicon-check"></span>
                        Show
                    </button>
                </form>
                {{--<a href="{{route('user.packages.show', [Auth::user()->id, $unread->data['package']['id']])}}">--}}
                    {{--Your package #{{$unread->data['package']['id']}}: {{$unread->data['message']}}--}}
                {{--</a>--}}
            </td>
        </tr>
    @endforeach
    @foreach($notifications as $notification)
        <tr>
          <td>Changed at #{{$notification->created_at}}</td>
          <td>{{$notification->data['message']}}</td>
          <td> #{{$notification->data['package']['id']}}</td>
          <td>
            <a href="{{route('user.notifications.show', [Auth::user()->id,
                $notification->id])}}" class="btn btn-info">
              Show
            </a>
          </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
