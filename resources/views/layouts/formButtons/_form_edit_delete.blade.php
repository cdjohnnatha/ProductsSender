<section>
   <a href="javascript:void(0)" class="edit-product icon"><i class="zmdi zmdi-delete"></i></a>
    <a href="{{route($prefix_name.'.edit', $id)}}" class="edit-product icon">
      <i class="zmdi zmdi-edit"></i>
    </a>

    <a href="{{route($prefix_name.'.edit', $id)}}" class="edit-product icon"
       onclick="event.preventDefault(); document.getElementById('delete-form-{{$id}}').submit();">
      <i class="zmdi zmdi-delete"></i>
    </a>
  <form action="{{route($prefix_name.'.destroy', $id)}}" method="POST"  role="form" id="delete-{{$id}}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
  </form>
</section>