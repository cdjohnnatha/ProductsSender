@extends('package.client.sendPackage.send_wizard_layout')


@section('preparePackageWizard')

    @if(Request::is('*/edit'))
        <form action=" {{ route('user.packages.processPackageWizard') }}" role="form" method="POST">
            <input name="_method" type="hidden" value="PUT">
    @else
        <form action="" role="form" method="POST">
            @endif
            {{ csrf_field() }}
            <input type="hidden" name="step" value="{{ $data['step'] }}">
            <section class="tab-pane active" id="tab1">
                @foreach($data['packages'] as $package)
                    @include('package.fragments._informations')
                @endforeach
            </section>
            <footer class="card-footer">
                <ul class="pager wizard">
                    @include('layouts.formButtons.wizard._wizard_buttons', ['tagDisabled' => 'disabled', 'finish' => false])
                </ul>
            </footer>
        </form>
@endsection
