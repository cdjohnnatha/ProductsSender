@extends('layouts.app')

@section('content')
    <link href="{{asset('css/plans.css')}}" rel="stylesheet">
    <section class="columns">
        <ul class="price">
            <li class="header">Basic</li>
            <li class="grey">$ 2.99 / month</li>
            <li>1 packet at warehouse per time</li>
            <li>Your address in USA</li>
            <li>Free storage for 30 days</li>
            <li>$2 per box</li>
            <li class="grey">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register.account') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="plan" value="basic">
                    <button class="button">Basic</button>
                </form>
            </li>
        </ul>
    </section>
    <section class="columns blueBG">
        <ul class="price">
            <li class="header">Medium</li>
            <li class="grey">$ 5.99 / month</li>
            <li>Many packets at warehouse</li>
            <li>Descounts of 80%</li>
            <li>Free storage for 30 days</li>
            <li>$2 per box</li>
            <li class="grey">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register.account') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="plan" value="medium">
                    <button class="button">Basic</button>
                </form>
            </li>
        </ul>
    </section>
    <section class="columns greenBG">
        <ul class="price">
            <li class="header">Pro</li>
            <li class="grey">$ 8.00 / month</li>
            <li>Many packets at warehouse</li>
            <li>Descounts of 80%</li>
            <li>Free storage for 30 days</li>
            <li>$2 per box</li>
            <li class="grey">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register.account') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="plan" value="pro">
                    <button class="button"> Pro </button>
                </form>
            </li>
        </ul>
    </section>

@endsection