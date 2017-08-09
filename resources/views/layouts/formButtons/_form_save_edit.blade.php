<button type="submit" id="submit-button" class="btn btn-success pull-right">
  @if(Request::is('*/edit'))
    {{__('buttons.titles.update')}}
  @else
    {{__('buttons.titles.create')}}
  @endif
</button>