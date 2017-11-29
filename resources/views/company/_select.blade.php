<section id="company_select">
    <select class="select form-control" name="{{$fieldName}}">
      @foreach($companies as $company)
        <option value="{{$company->id or old('company')}}">
            {{$company->name}}
        </option>
      @endforeach
    </select>
    @if ($errors->has('company'))
    <span class="help-block">
        <strong class="text-danger" class="alert-danger">
          {{ $errors->first('company') }}
        </strong>
    </span>
    @endif
</section>
