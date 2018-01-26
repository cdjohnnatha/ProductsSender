@extends('layouts.app')

@section('content')
    <div id="content" class="container">
        <div class="content-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="card">

                        <div class="card-body p-0">
                            <div class="tabpanel">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active" role="presentation">
                                        <a href="#tab-13" data-toggle="tab" aria-expanded="true">General</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tab-14" data-toggle="tab" aria-expanded="true">Documents</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content p-20">
                                <div class="tab-pane fadeIn active" id="tab-13">
                                    <header class="card-heading ">
                                        <h2 class="card-title">General Settings</h2>
                                    </header>
                                    <form class="form-horizontal">
                                        <div class="form-group is-empty">
                                            <label for="siteName" class="col-md-2 control-label">@lang('user.client.form.name')</label>
                                            <div class="col-xs-10">
                                                <input type="text" class="form-control" name="name" value="{{ $data['client']->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group is-empty">
                                            <label for="siteOwner" class="col-md-2 control-label">@lang('user.client.form.surname')</label>
                                            <div class="col-xs-10">
                                                <input type="text" class="form-control" name="surname" value="{{ $data['client']->surname }}">
                                            </div>
                                        </div>
                                        <div class="form-group is-empty">
                                            <label for="emailAddress" class="col-md-2 control-label">@lang('user.client.form.email')</label>
                                            <div class="col-xs-10">
                                                <input type="email" class="form-control" name="email" value="{{ $data['client']->user->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group is-empty">
                                            <label for="identity_document" class="col-md-2 control-label">@lang('user.client.form.identity_document')</label>
                                            <div class="col-xs-10">
                                                <input type="text" class="form-control" name="identity_document" value="{{ $data['client']->identity_document }}">
                                            </div>
                                        </div>
                                        <div class="form-group is-empty">
                                            <label for="tax_document" class="col-md-2 control-label">@lang('user.client.form.tax_document')</label>
                                            <div class="col-xs-10">
                                                <input type="text" class="form-control" name="tax_document" value="{{ $data['client']->tax_document }}">
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <div class="col-md-12">
                                                <a href="/user/dashboard" class="btn btn-primary btn-flat ">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fadeIn" id="tab-14">
                                    <header class="card-heading ">
                                        <h2 class="card-title">Documents</h2>
                                    </header>
                                    <form class="form-horizontal">
                                        <div class="form-group is-empty">
                                            <label for="siteName" class="col-md-2 control-label">Page Title</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="siteName"
                                                       placeholder="Site Name"
                                                       value="Welcome to the MaterialWrap Store">
                                            </div>
                                        </div>
                                        <div class="form-group is-empty">
                                            <label for="textArea" class="col-md-2 control-label">Meta Keywords</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="3" id="textArea"
                                                          placeholder="Bootstrap, Material Design, Admin Themes, etc."></textarea>
                                                <span class="help-block">These are the keywords used for improving search engine results of our site. (Comma separated for multiple keywords.)</span>
                                            </div>
                                        </div>
                                        <div class="form-group is-empty">
                                            <label for="textArea" class="col-md-2 control-label">Meta
                                                Description</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="3" id="textArea"
                                                          placeholder="A Multipurpose UI Dashboard Kit for Web Application Development"></textarea>
                                                <span class="help-block">This is the short description of your site, used by search engines on search result pages to display preview snippets for a given page.</span>
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary btn-flat ">Cancel</button>
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection