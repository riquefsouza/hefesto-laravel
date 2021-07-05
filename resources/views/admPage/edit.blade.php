@extends('layout')

@section('title')
Edit Pages
@endsection

@section('content')

<form id="formEditAdmPage" style="padding: 5px;" method="post" action="/admPage/save">

    @csrf

    <div class="card">
        <div class="card-header"
             style="font-weight: bold;font-size: large;">
             {{ $messages["editAdmPage.title"] }}
        </div>
        <div class="card-body">
            <div class="form-actions">
                <button type="submit" class="btn btn-success" id="btnSave">
                    <span class="icon text-white-50">
                        <i class="fa fa-check-circle"></i>
                    </span>
                    <span class="text">{{ $messages["button.save"] }}</span>
                </button>

                <button type="reset" class="btn btn-light" id="btnReset">
                    <span class="icon text-gray-600">
                        <i class="fa fa-eraser"></i>
                    </span>
                    <span class="text">{{ $messages["button.reset"] }}</span>
                </button>

                <button type="button" class="btn btn-primary" id="btnCancel">
                    <span class="icon text-white-50">
                        <i class="fa fa-times-circle"></i>
                    </span>
                    <span class="text">{{ $messages["button.cancel"] }}</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-8 form-group mb-2">
                    <input type="hidden" id="id" name="id" value="{{ $model->getIdAttribute() }}" />

                    <label for="url">{{ $messages["editAdmPage.url"] }}</label>
                    <input type="text" class="form-control" id="url" name="url"
                        maxlength="255" required="required" value="{{ $model->getUrlAttribute() }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 form-group mb-2">
                    <label for="description">{{ $messages["editAdmPage.description"] }}</label>
                    <input type="text" class="form-control" id="description" name="description"
                        maxlength="255" required="required" value="{{ $model->getDescriptionAttribute() }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 form-group mb-2">
                    <label for="pickListProfiles">{{ $messages["editAdmPage.pickListProfiles"] }}</label>
                    <div class="row ms-1">
                        <div class="col-md-5">
                            <div class="row">
                                <input type="text" class="form-control" id="edtSource_pickListProfiles" maxlength="20" />
                                <input class="form-control" type="text" placeholder="{{ $messages["editAdmPage.sourceCaptionProfiles"] }}" disabled>
                            </div>
                            <div class="row">
                                <select id="bufferSource_pickListProfiles" class="form-select" style="display: none">
                                    @foreach ($listSourceAdmProfiles as $itemProfile)
                                        <option value="{{ $itemProfile->getIdAttribute() }}">{{ $itemProfile->getDescriptionAttribute() }}</option>
                                    @endforeach
                                </select>
                                <select id="source_pickListProfiles" class="form-select" size="10" multiple>
                                    @foreach ($listSourceAdmProfiles as $itemProfile)
                                        <option value="{{ $itemProfile->getIdAttribute() }}">{{ $itemProfile->getDescriptionAttribute() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex justify-content-center align-items-center">
                            <div class="btn-group-vertical btn-group-sm">
                                <button type="button" class="btn btn-primary" id="btnRight_pickListProfiles">
                                    <span class="icon text-white-50"><i class="fa fa-angle-right"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnAllRight_pickListProfiles">
                                    <span class="icon text-white-50"><i class="fa fa-angle-double-right"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnLeft_pickListProfiles">
                                    <span class="icon text-white-50"><i class="fa fa-angle-left"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnAllLeft_pickListProfiles">
                                    <span class="icon text-white-50"><i class="fa fa-angle-double-left"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <input type="text" class="form-control" id="edtTarget_pickListProfiles" maxlength="20" />
                                <input class="form-control" type="text" placeholder="{{ $messages["editAdmPage.targetCaptionProfiles"] }}" disabled>
                            </div>
                            <div class="row">
                                <select id="bufferTarget_pickListProfiles" class="form-select" style="display: none">
                                    @foreach ($listTargetAdmProfiles as $itemProfile)
                                        <option value="{{ $itemProfile->getIdAttribute() }}">{{ $itemProfile->getDescriptionAttribute() }}</option>
                                    @endforeach
                                </select>
                                <select asp-for="AdmIdProfiles" id="target_pickListProfiles" class="form-select" size="10" multiple>
                                    @foreach ($listTargetAdmProfiles as $itemProfile)
                                        <option value="{{ $itemProfile->getIdAttribute() }}">{{ $itemProfile->getDescriptionAttribute() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <br>
    <br>
</form>

<script src="/static/js/admin/admPage/editAdmPage.js"></script>

@endsection
