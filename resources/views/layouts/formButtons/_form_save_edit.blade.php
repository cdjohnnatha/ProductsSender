<section>
  <a href="{{$url}}" class="btn btn-primary btn-flat" data-toggle="tooltip"
     data-placement="top" title="{{__('buttons.titles.cancel')}}">Cancel</a>
  <button type="submit" id="submit-button" class="btn btn-primary" data-toggle="tooltip"
          data-placement="top" title="{{__('buttons.titles.register')}}">
    @if(Request::is('*/edit'))
      {{__('buttons.titles.update')}}
    @else
      {{__('buttons.titles.create')}}
    @endif
  </button>
</section>