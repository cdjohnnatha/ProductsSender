<section class="content-body">
  <div class="row">
    <div class="col-xs-12">
      <div class="card card-data-tables product-table-wrapper">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table id="addonsTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th data-orderable="false" class="col-xs-2">
                  <a href="{{Route('admin.companies.addons.create', $company->id)}}">
                    <button class="btn btn-primary btn-fab animate-fab"><i class="zmdi zmdi-plus"></i></button>
                  </a>
                </th>
              </tr>
              </thead>
              <tbody>
              @foreach($company->addons as $addon)
                <tr>
                  <td>{{$addon->id}}</td>
                  <td>{{$addon->title}}</td>
                  <td>

                    <a href="#" class="icon"
                       onclick="window.location='{{Route("admin.companies.addons.edit", [$company->id, $addon->id])}}'"
                       data-toggle="tooltip"
                       data-placement="top" title="{{__('buttons.titles.edit')}}">
                      <i class="zmdi zmdi-edit"></i>
                    </a>

                    <a href="javascript:void(0)" class="icon alerting-delete" id="delete-button-{{$addon->id}}"
                       formSubmitId="delete-form-{{$addon->id}}" data-toggle="tooltip" data-placement="top"
                       title="{{__('buttons.titles.delete')}}">
                      <i class="zmdi zmdi-delete"></i>
                    </a>
                    <form action="{{route('admin.companies.addons.destroy', [$company->id, $addon->id])}}" method="POST"
                          role="form" id="delete-form-{{$addon->id}}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
