<section>
  <a href="{{$url}}" class="btn btn-primary btn-flat">Cancel</a>
  <button type="submit" id="submit-button" class="btn btn-primary">
    @if(Request::is('*/edit'))
      {{__('buttons.titles.update')}}
    @else
      {{__('buttons.titles.create')}}
    @endif
  </button>
</section>