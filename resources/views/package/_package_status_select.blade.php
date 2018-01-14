<section>
  <label class="control-label">{{ __('packages.form.status') }}</label>
  <select class="select form-control" name="{{ $tagName }}">
    @foreach($packageStatus as $item)
      @if(Request::is('*/edit'))
        <option value="{{ $item->id }}" {{ old($tags, $package->packageStatus->id) === $item->id  ? 'selected' : '' }}>
      @else
        <option value="{{ $item->id }}" {{ old($tags) === $item->id  ? 'selected' : '' }}>
      @endif
          {{$item->message}}
        </option>
        @endforeach
  </select>
</section>
