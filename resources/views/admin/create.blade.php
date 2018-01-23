@extends('layouts.app')

@section('panel_header')
    Admins of Holyship
@endsection

@section('content')
<section class="content-body">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="card">
                <header class="card-heading ">
                    <h2 class="card-title">Form Admin</h2>
                    <ul class="card-actions icons right-top">
                        <li>
                            <a href="javascript:void(0)" data-toggle-view="code">
                                <i class="zmdi zmdi-code"></i>
                            </a>
                        </li>
                    </ul>
                </header>
                @if(Request::is('*/edit'))
                    <?php $action = 'admin.update' ?>
                    <form action="{{route($action, $admin->id)}}" role="form" method="POST">
                    <input name="_method" type="hidden" value="PUT">
                @else
                <?php $action = 'admin.store' ?>
                <form action="{{route($action)}}" role="form" method="POST">
                @endif
                    {{ csrf_field() }}
                    <section class="card-body">
                        <article>
                            <section class="row">
                                <div class="form-group col-sm-6 label-floating {{ $errors->has('fullname') ? ' has-error' : '' }}">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                        <label class="control-label">@lang('user.admin.fullname')</label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{ $admin->fullname or old('fullname') }}">

                                        @if ($errors->has('fullname'))
                                            <span class="help-block">
                                                <strong class="text-danger" class="alert-danger">
                                                  {{ $errors->first('fullname') }}
                                                </strong>
                                              </span>
                                        @endif
                                    </div>
                                </div>

                                <section class="form-group col-sm-6 {{ $errors->has('email') ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                               value="{{ $admin->email or old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                          <strong class="text-danger" class="alert-danger">
                                            {{ $errors->first('email') }}
                                          </strong>
                                        </span>
                                        @endif
                                    </div>
                                </section>
                            </section>


                            <section class="row">
                                <section class="form-group col-sm-6 {{ $errors->has('phone') ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
                                        <label class="control-label">@lang('user.admin.phone')</label>
                                        <input type="text" class="form-control" name="phone"
                                               value="{{ $admin->phone or old('phone') }}">

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                              <strong class="text-danger" class="alert-danger">
                                                {{ $errors->first('phone') }}
                                              </strong>
                                            </span>
                                        @endif
                                    </div>
                                </section>

                                <section class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
                                        <label class="control-label">@lang('user.admin.select_company')</label>
                                        {{--@include('company_warehouse._select')--}}
                                    </div>
                                </section>
                            </section>

                            <section class="row">
                                <div class="form-group col-sm-6 {{ $errors->has('password') ? 'has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                                        <label class="control-label">@lang('user.admin.password')</label>
                                        <input type="text" class="form-control" name="password"
                                               value="{{ old('password') }}">


                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong class="text-danger" class="alert-danger">
                                                  {{ $errors->first('password') }}
                                                </strong>
                                              </span>
                                            <span class="zmdi zmdi-close form-control-feedback"></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">@lang('user.admin.password_confirm')</label>
                                    <input type="text" class="form-control" name="password_confirmation">
                                </div>
                            </section>
                        </article>
                    </section>
                    <footer class="card-footer text-right">
                        @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.index')])
                    </footer>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
