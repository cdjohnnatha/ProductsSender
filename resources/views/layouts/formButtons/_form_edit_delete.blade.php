<section>
  <div class="col-sm-5">
    <a href="{{route($prefix_name.'.edit', $id)}}" class="edit-modal btn btn-warning" id="edit-{{$id}}">
      <span class="glyphicon glyphicon-edit"></span>
      {{ __('buttons.titles.edit') }}
    </a>
  </div>
  <form action="{{route($prefix_name.'.destroy', $id)}}" method="POST"  role="form">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-danger" id="delete-{{$id}}">
      <span class="glyphicon glyphicon-trash"></span>
      {{ __('buttons.titles.delete') }}
    </button>
  </form>
</section>