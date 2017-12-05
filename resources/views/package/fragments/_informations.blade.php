<section class="tab-content  p-20">
  <div class="card-body p-0">
    @include('package.fragments._image_card_galery')
    <section class="table-responsive">
      <table class="table table-hover">
        <thead>
        <tr>
          <th colspan="2"><h2>{{ __('common.titles.informations') }}</h2></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <th>{{ __('common.titles.status') }}</th>
          <td class="md-bg-blue-50">{{ $package->packageStatus->message }}</td>
        </tr>
        <tr>
          <th>{{__('packages.form.dimensions')}}:</th>
          <td>
            {{ $package->depth.' x '.$package->height.' x '.$package->width.' '.$package->unit_measure }}
          </td>
        </tr>
        <tr>
          <th>{{ __('packages.form.weight') }}:</th>
          <td>{{ $package->weight.' '.$package->weight_measure }}</td>
        </tr>
        <tr>
          <th>Description</th>
        </tr>
        </tbody>
      </table>
    </section>
    <div class="clearfix"></div>
  </div>
</section>
