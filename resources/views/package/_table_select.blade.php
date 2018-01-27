<form action="{{ Route('user.packages.processPackageWizard') }}" id="send_merge_packages" method="POST" role="form">
    {{ csrf_field() }}
    <table id="{{$table_id}}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="col-sm-1" data-orderable="false"></th>
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
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="packages_id[]" value="{{$package->id}}"
                                   warehouse_id="{{$package->companyWarehouse->id}}">
                        </label>
                    </div>
                </td>
                <td>
                    @if(count($package->pictures) > 0)
                        <img src="{{$package->pictures[0]->path}}" alt="" class="img-thumbnail"/>
                    @endif
                </td>
                <td>{{$package->companyWarehouse->name}}</td>
                <td><span class="label label-default">{{$package->packageStatus->message}}</span></td>
                <td>
                    {{$package->note}}
                    @if(!$package->goodsDeclaration)
                        <p class="text-danger">@lang('packages.goods.required_declaration')</p>
                    @endif
                </td>
                <td>{{Carbon\Carbon::parse($package->updated_at)->format('d/m/Y')}}</td>
                <td>


                    <section id="sweet_alerts_card">
                        @if($package->goodsDeclaration)
                            {{--<a href="#" onclick="window.location='{{Route('user.packages.send', $package->id)}}'"--}}
                            {{--class="icon" data-placement="top" title="@lang('buttons.titles.send_package')"--}}
                            {{--data-toggle="tooltip">--}}
                            {{--<i class="zmdi zmdi-mail-send"></i>--}}
                            {{--</a>--}}

                            <a href="#" class="icon"
                               onclick="window.location='{{Route("user.packages.show", $package->id)}}'"
                               data-toggle="tooltip"
                               data-placement="top" title="@lang('buttons.titles.show')">
                                <i class="zmdi zmdi-search"></i>
                            </a>

                            <a href="" class="icon alerting-delete deletePackage" id="{{$package->id}}"
                               data-toggle="tooltip" data-placement="top" title="@lang('buttons.titles.delete')">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        @else
                            {{--<a href="#" onclick="window.location='{{Route('user.goods.create', $package->id)}}'" class="icon" data-placement="top" title="@lang('buttons.titles.required_custom_clearance')}}" data-toggle="tooltip">--}}
                            {{--<i class="zmdi zmdi-assignment"></i>--}}
                            {{--</a>--}}
                        @endif

                    </section>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</form>
<form action="/" method="POST" role="form" id="delete-form">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

@section('footerJS')
    @parent
    <script>
        var warehouse_id, checkedLength;
        warehouse_id = 0;

        function loadCheckbox() {
            $('input[type="checkbox"]').each(function () {
                if (warehouse_id == 0) {
                    $(this).attr('disabled', false);
                } else {
                    if (warehouse_id != $(this).attr('warehouse_id')) {
                        $(this).attr('disabled', true);
                    }
                }

                if(checkedLength >= 1){
                    $('#send_packages').attr('disabled', false);
                } else {
                    $('#send_packages').attr('disabled', true);
                }


            });
        }

        $('input[type="checkbox"]').click(function () {
            checkedLength = $('input[type="checkbox"]:checked').length;
            if ($(this).is(":checked") && checkedLength <= 1) {
                warehouse_id = $(this).attr('warehouse_id');
                loadCheckbox();
            }

            if (checkedLength <= 0) {
                warehouse_id = 0;
                loadCheckbox();
            }
        });

        $('.deletePackage').click(function(){
           var deleteForm = $('#delete-form');
           var id = $(this).attr('id');
           deleteForm.attr('action', '/user/packages/' + id);
           deleteForm.submit();
        });
    </script>
@endsection