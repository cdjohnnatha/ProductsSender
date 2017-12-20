<section class="tab-content  p-20">
  <div class="card-body p-0">
    @include('package.fragments._image_card_galery')
    <section class="table-responsive">
      <table class="table table-hover">
        <thead>
        <tr>
          <th colspan="2"><h2>@lang('packages.prepare_package.package_information')</h2></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <th>@lang('packages.prepare_package.status')</th>
          <td class="md-bg-blue-50">{{ $package->packageStatus->message }}</td>
        </tr>
        <tr>
          <th>@lang('packages.form.dimensions'):</th>
          <td>
            {{ $package->depth.' x '.$package->height.' x '.$package->width.' '.$package->unit_measure }}
          </td>
        </tr>
        <tr>
          <th>@lang('packages.form.weight'):</th>
          <td>{{ $package->weight.' '.$package->weight_measure }}</td>
        </tr>
        <tr>
          <th>Description</th>
          <td>{{ $package->description }}</td>
        </tr>
        </tbody>
      </table>
    </section>
    <div class="clearfix"></div>
  </div>
  <input type="hidden" name="packages_id[]" value="{{ $package->id }}">
</section>
