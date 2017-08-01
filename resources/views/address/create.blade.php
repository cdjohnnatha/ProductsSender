
<section class="container">
    <div class="panel panel-default">
        <header class="panel-heading">
            New Address
        </header>
            <section class="panel-body">
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="label-address">Name for address</label>
                        <input type="text" class="form-control" name="label-address">
                    </div>
                    <div class="col-sm-4">
                        <label for="owner-name">First Name</label>
                            <input type="text" class="form-control" name="owner-name">
                    </div>
                    <div class="col-sm-3">
                        <label for="owner-surname">Surname</label>
                             <input type="text" class="form-control" name="owner-surname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="col-sm-3">
                        <label for="company-name">Company Name</label>
                        <input type="text" class="form-control" name="company-name">
                    </div>
                    <div class="col-sm-6">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city">
                    </div>
                    <div class="col-sm-3">
                        <label for="state">State/Province/neighborhood</label>
                        <input type="text" class="form-control" name="state">
                    </div>
                    <div class="col-sm-2">
                        <label for="postal-code">Postal Code</label>
                        <input type="text" class="form-control" name="postal-code">
                    </div>
                    <div class="col-sm-3">
                        <label for="country">Country</label>
                        @include('layouts._countries_combobox')
                    </div>

                </div>
            </section>
            <section class="panel-footer">
                <div class="col-sm-1 pull-right">
                    <button type="submit" class="btn btn-primary pull-right">
                        Next
                    </button>
                </div>
                <div class="clearfix"></div>
            </section>
    </div>
</section>
