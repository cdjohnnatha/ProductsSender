@extends('layouts.app')

@section('panel_header')
    @lang('packages.index.title_package')
@endsection


@section('content')
    <section class="card">
        <header class="card-body p-0">
            <div class="tabpanel">
                <ul class="nav nav-tabs nav-tabs-right">
                    <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab"
                                                              aria-expanded="true">@lang('packages.index.inbox')</a>
                    </li>
                    <li class="presentation" role="presentation"><a href="#tab-2" data-toggle="tab"
                                                                    aria-expanded="true">@lang('packages.index.incoming')</a>
                    </li>
                    <li class="presentation" role="presentation"><a href="#tab-3" data-toggle="tab"
                                                                    aria-expanded="true">@lang('packages.index.sent')</a>
                    </li>
                </ul>
            </div>
        </header>


        <section class="tab-content  p-20">

            <section class="tab-pane fadeIn active" id="tab-1">
                <header class="card-heading">
                    <ul class="card-actions right-top">
                        <li>
                            <button type="button" id="send_packages" class="btn btn-info btn-flat">
                                <i class="zmdi zmdi-mail-send"></i>
                                @lang('packages.index.btn_send_packages')
                            </button>
                        </li>
                        {{--<li>--}}
                            {{--<button type="btn" id="merge_packages" class="btn btn-info btn-flat">--}}
                                {{--<i class="zmdi zmdi-group"></i>--}}
                                {{--@lang('packages.index.btn_merge_packages')--}}
                            {{--</button>--}}
                        {{--</li>--}}
                    </ul>
                </header>
                <h2 class="card-title">{{ __('packages.index.title_package') }}</h2>
                <small class="dataTables_info">@lang('packages.index.short_description')</small>

                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">

                                @include('package._table_select', ['packages' => $packagesRegistered, 'table_id' => 'productsTable-warehouse'])
                            {{--</form>--}}
                        </div>
                    </div>
                </div>
            </section>


            <section class="tab-pane fadeIn" id="tab-2">
                <header class="card-heading">
                    <ul class="card-actions right-top">
                        <li>
                            <a href="{{ route('user.packages.create') }}" class="btn btn-info btn-flat">
                                <i class="zmdi zmdi-notifications-add"></i>
                                @lang('buttons.titles.incoming_package_inform')
                            </a>
                        </li>
                    </ul>
                </header>
                <h2 class="card-title">@lang('packages.index.incoming')</h2>
                <small class="dataTables_info">@lang('packages.index.incoming_short_description')</small>

                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                            @include('package._table', ['packages' => $packagesIncoming,'table_id' => 'incoming-table'])
                        </div>
                    </div>
                </div>
            </section>

            <section class="tab-pane fadeIn" id="tab-3">
                <h2 class="card-title">@lang('packages.index.sent')</h2>
                <small class="dataTables_info">@lang('packages.index.sent_short_description')</small>

                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                            @include('package._table', ['packages' => $packagesSent, 'table_id' => 'productsSent'])
                        </div>
                    </div>
                </div>
            </section>
        </section>
        @endsection

        @section('footerJS')
            <script>
                var form = $('#send_merge_packages');
                console.log(form);
                $('#send_packages').click(function(){
                   {{--form.attr('action', '{{ Route('user.packages.sendPackage') }}');--}}
                   form.submit();
                });

                $('#merge_packages').click(function(){
                   alert("test");
                });
            </script>
        @endsection