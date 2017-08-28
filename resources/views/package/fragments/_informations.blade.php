<section class="tab-content  p-20">
  <div class="card-body p-0">
    @include('package.fragments._image_card_galery')
    <section class="table-responsive">
      <table class="table table-hover">
        <thead>
        <tr>
          <th colspan="2"><h2>Informations</h2></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <th>Status</th>
          <td class="md-bg-blue-50">{{$package->status->status}}</td>
        </tr>
        <tr>
          <th>Dimensions (C x A x L):</th>
          <td>
            {{$package->depth.' x '.$package->height.' x '.$package->width.' '.$package->unit_measure}}
          </td>
        </tr>
        <tr>
          <th>Weight:</th>
          <td>{{$package->weight.' '.$package->weight_measure}}</td>
        </tr>
        </tbody>
      </table>
    </section>
    <div class="clearfix"></div>
  </div>
</section>
