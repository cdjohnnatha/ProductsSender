<table id="{{ $idName }}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th class="col-sm-1">Id</th>
    <th class="col-sm-2">Picture</th>
    <th class="col-sm-1">Suite</th>
    <th class="col-sm-2">Status</th>
    <th>Content Type</th>
    <th>Note</th>
    <th data-orderable="false" class="col-xs-2">
      <a href="{{Route('admin.packages.create')}}">
        <button class="btn btn-primary btn-fab  animate-fab"><i class="zmdi zmdi-plus"></i></button>
      </a>
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach($packages as $package)
    <tr>
      <td>{{ $package->id }}</td>
      <td>
        @if(count($package->pictures) > 0)
          <img src="{{ $package->pictures[0]->path }}" alt="" class="img-thumbnail"/>
        @endif
      </td>
      <td>{{ $package->client->id .' - '.$package->client->name }}</td>
      <td><span class="label label-default">{{ $package->packageStatus->message }}</span></td>
      <td>{{ $package->content_type }}</td>
      <td>{{ $package->note }}</td>
      <td>
        @include('layouts.formButtons._form_all', ['prefix_name' => 'admin.packages' ,'id' => $package->id])
      </td>
    </tr>
  @endforeach
  </tbody>
</table>