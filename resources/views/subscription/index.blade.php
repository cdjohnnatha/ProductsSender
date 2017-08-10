@extends('layouts.app')

@section('content')
<link href="{{asset('css/plans.css')}}" rel="stylesheet">
<div class="panel-heading">Plans</div>
<div class="panel-body">
    @foreach($subscriptions as $subscription)
        <section id="lists">
            <div class="columns">
                <ul class="price">
                    <li class="header">{{$subscription->title}}</li>
                    <li class="grey">$ {{$subscription->amount}} / month</li>
                    @foreach($subscription->benefits as $benefit)
                        <li>{{$benefit->message}}</li>
                    @endforeach
                    <li>
                        @include('layouts.formButtons._form_edit_delete', array('prefix_name' => 'admin.subscriptions', 'id' => $subscription->id))
                    </li>
                </ul>
            </div>
        </section>
    @endforeach
</div>

@endsection
