@extends('layouts.app')

@section('panel_header')
  {{__('packages.incoming.form.goods_custom_clearance')}}
@endsection

@section('content')

  <section class="card">
    <section class="tab-content  p-20">
      <section class="tab-pane fadeIn active" id="tab-1">
        <div class="row">
          <header class="card-heading">
            <h2 class="card-title">{{__('packages.goods.short_description_check')}}</h2>
          </header>
          <form action="{{route('user.goods.store', $package_id)}}" role="form" method="POST">
            {{ csrf_field() }}
            <section class="card-body">
              <section class="row">
                <div class="form-group col-sm-6 label-floating {{ $errors->has('goods.provider') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <label class="control-label">{{__('packages.incoming.form.provider')}}</label>
                    <input type="text" class="form-control" name="goods[provider]" value="{{$goods->provider or old('goods.provider')}}">

                    @if ($errors->has('goods.provider'))
                      <span class="help-block">
                        <strong class="text-danger" class="alert-danger">
                          {{ $errors->first('goods.provider') }}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>

                <section class="form-group col-sm-6 label-floating {{ $errors->has('goods.package_content') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-tag"></i></span>
                    <label class="control-label">{{__('packages.incoming.form.package_content')}}</label>

                    <select class="select form-control" name="goods[content_type]">
                      <option value="0"  {{old('goods.content_type')}}>Merchandise</option>
                      <option value="1" {{old('goods.content_type')}}>Gift</option>
                    </select>

                    @if ($errors->has('goods.content_type'))
                      <span class="help-block">
                        <strong class="text-danger" class="alert-danger">
                          {{ $errors->first('goods.content_type') }}
                        </strong>
                      </span>
                    @endif
                  </div>
                </section>

                <section class="form-group col-sm-12 label-floating {{ $errors->has('goods.description') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-comment-edit"></i></span>
                    <label class="control-label">{{__('packages.goods.content_description')}}</label>
                    <textarea tabindex="2" class="form-control" name="goods[description]">
                      {{$goods->description or old('goods.description')}}
                    </textarea>

                    @if ($errors->has('goods.description'))
                      <span class="help-block">
                        <strong class="text-danger" class="alert-danger">
                          {{ $errors->first('goods.description') }}
                        </strong>
                      </span>
                    @endif
                  </div>
                </section>

                <section class="{{ $errors->has('goods.description') ? ' has-error' : '' }}">
                  @if(Request::is('*/edit'))
                    <custom-clearance-form :editing="{{$incoming->goodsDeclaration()->get()}}"></custom-clearance-form>
                  @else
                    <custom-clearance-form></custom-clearance-form>
                  @endif
                </section>


              </section>
            </section>
            <footer class="card-footer text-right">
              <a href="{{ route('user.packages.index') }}" class="btn btn-primary btn-flat" data-toggle="tooltip"
                 data-placement="top" title="{{__('buttons.titles.cancel')}}">Cancel</a>
              <button type="submit" id="submit-button" class="btn btn-primary" data-toggle="tooltip"
                      data-placement="top" title="{{__('buttons.titles.register')}}">
                @if(Request::is('*/edit'))
                  {{__('buttons.titles.update')}}
                @else
                  {{__('buttons.titles.create')}}
                @endif
              </button>
            </footer>
          </form>
        </div>
      </section>
      <section class="tab-pane" id="tab-2">

      </section>
    </section>
  </section>
@endsection