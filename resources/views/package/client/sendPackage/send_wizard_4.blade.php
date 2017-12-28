@extends('package.client.sendPackage.send_wizard_layout')


@section('preparePackageWizard')
    @include('client.invoice._invoice')
@endsection


@section('footerJS')
    <script>
        $('#package_shipment').removeClass('active');
        $('#package_confirmation').addClass('active');
    </script>
@endsection