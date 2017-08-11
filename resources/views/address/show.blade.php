<section>
  <div class="form-group">
    <label>Addressee:</label>
    <span>{{$address->owner_name.' '.$address->owner_surname}}</span>
  </div>
  <div class="form-group">
    <label>Phone:</label>
    <span>{{$address->phone}}</span>
  </div>
  <div class="form-group">
    <label>Address:</label>
    <span>{{$address->address}}</span>
  </div>
  <div class="form-group">
    <label>Postal Code:</label>
    <span>{{$address->postal_code}}</span>
  </div>
  <div class="form-group">
    <label>City/State:</label>
    <span>{{$address->city.'/'.$address->state}}</span>
  </div>
  <div class="form-group">
    <label>Country</label>
    <span>{{$address->country}}</span>
  </div>
  <div class="form-group">
    <label>Company Name:</label>
    <span>{{$address->company_name}}</span>
  </div>
  <div class="form-group">
    <label>Phone:</label>
    <span>{{$address->phone}}</span>
  </div>
</section>