<section>
  <a href="#" class="icon" onclick="window.location='{{Route($prefix_name.".show", $id)}}'">
    <i class="zmdi zmdi-search"></i>
  </a>

  <a href="#" class="icon" onclick="window.location='{{Route($prefix_name.".edit", $id)}}'">
    <i class="zmdi zmdi-edit"></i>
  </a>

  <a href="javascript:void(0)" class="icon alerting-delete" id="delete-button-{{$id}}" formSubmitId="delete-form-{{$id}}">
    <i class="zmdi zmdi-delete"></i>
  </a>
  <form action="{{route($prefix_name.'.destroy', $id)}}" method="POST"  role="form" id="delete-form-{{$id}}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
  </form>
</section>