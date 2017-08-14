<table class="table table-striped" style="margin-bottom: 0;">
  <tbody>
    <tr>
      <th>Addressee:</th>
      <td>{{$address->owner_name.' '.$address->owner_surname. ' - '.$address->phone}}</td>
    </tr>
    <tr>
      <th>Address:</th>
      <td>{{$address->address.','.$address->city.'/'.$address->state
            .', '.$address->postal_code.', '.$address->country}}</td>
    </tr>
    <tr>
      <th>Company:</th>
      <td>{{$address->company_name}}</td>
    </tr>
  </tbody>
</table>