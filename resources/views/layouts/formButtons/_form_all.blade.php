<section>
  <div class="col-sm-4">
    <a href="{{route($prefix_name.'.show', $id)}}" class="edit-modal btn btn-info">
      <span class="glyphicon glyphicon-edit"></span>
      {{ __('buttons.titles.show') }}
    </a>
  </div>
  <div class="col-sm-4">
    <a href="{{route($prefix_name.'.edit', $id)}}" class="edit-modal btn btn-warning">
      <span class="glyphicon glyphicon-edit"></span>
      {{ __('buttons.titles.edit') }}
    </a>
  </div>
  <form action="{{route($prefix_name.'.destroy', $id)}}" method="POST"  role="form">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-danger">
      <span class="glyphicon glyphicon-trash"></span>
      {{ __('buttons.titles.delete') }}
    </button>
  </form>
</section>