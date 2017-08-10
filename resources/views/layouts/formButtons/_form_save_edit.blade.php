<section class="col-sm-2 pull-right">
  <button type="submit" id="submit-button" class="btn btn-success">
    @if(Request::is('*/edit'))
      {{__('buttons.titles.update')}}
    @else
      {{__('buttons.titles.create')}}
    @endif
  </button>
</section>
<section class="pull-right">
  <a href="{{$url}}" class="btn btn-warning">Cancel</a>
</section>