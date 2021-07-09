@extends('layout')

@section('title')
Edit Profiles
@endsection

@section('content')

<form id="formEditAdmProfile" style="padding: 5px;" method="post" action="{{ route("saveAdmProfile") }}">

    @csrf

    <div class="card">
        <div class="card-header"
             style="font-weight: bold;font-size: large;">
             {{ $messages["editAdmProfile.title"] }}
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

                <button type="button" class="btn btn-primary" id="btnCancel"
                    onclick="editAdmProfile.btnCancelClick('{{ route('listAdmProfile') }}');">
                    <span class="icon text-white-50">
                        <i class="fa fa-times-circle"></i>
                    </span>
                    <span class="text">{{ $messages["button.cancel"] }}</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-4 form-group mb-2">
                    <input type="hidden" id="id" name="id" value="{{ $model->getIdAttribute() }}" />

                    <label for="description">{{ $messages["editAdmProfile.description"] }}</label>
                    <input type="text" class="form-control" id="description" name="description"
                        maxlength="64" required="required" value="{{ $model->getDescriptionAttribute() }}" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 form-group mb-2">
                    <label for="pickListUsers">{{ $messages["editAdmProfile.pickListUsers"] }}</label>
                    <div class="row ms-1">
                        <div class="col-md-5">
                            <div class="row">
                                <input type="text" class="form-control" id="edtSource_pickListUsers" maxlength="20" />
                                <input class="form-control" type="text" placeholder="{{ $messages["editAdmProfile.sourceCaptionUsers"] }}" disabled>
                            </div>
                            <div class="row">
                                <select id="bufferSource_pickListUsers" class="form-select" style="display: none">
                                    @foreach ($listSourceAdmUsers as $itemUser)
                                        <option value="{{ $itemUser->getIdAttribute() }}">{{ $itemUser->getNameAttribute() }}</option>
                                    @endforeach
                                </select>
                                <select id="source_pickListUsers" class="form-select" size="10" multiple>
                                    @foreach ($listSourceAdmUsers as $itemUser)
                                        <option value="{{ $itemUser->getIdAttribute() }}">{{ $itemUser->getNameAttribute() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex justify-content-center align-items-center">
                            <div class="btn-group-vertical btn-group-sm">
                                <button type="button" class="btn btn-primary" id="btnRight_pickListUsers">
                                    <span class="icon text-white-50"><i class="fa fa-angle-right"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnAllRight_pickListUsers">
                                    <span class="icon text-white-50"><i class="fa fa-angle-double-right"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnLeft_pickListUsers">
                                    <span class="icon text-white-50"><i class="fa fa-angle-left"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnAllLeft_pickListUsers">
                                    <span class="icon text-white-50"><i class="fa fa-angle-double-left"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <input type="text" class="form-control" id="edtTarget_pickListUsers" maxlength="20" />
                                <input class="form-control" type="text" placeholder="{{ $messages["editAdmProfile.targetCaptionUsers"] }}" disabled>
                            </div>
                            <div class="row">
                                <select id="bufferTarget_pickListUsers" class="form-select" style="display: none">
                                    @foreach ($listTargetAdmUsers as $user)
                                        <option value="{{ $user->getIdAttribute() }}">{{ $user->getNameAttribute() }}</option>
                                    @endforeach
                                </select>
                                <select asp-for="AdmUsers" id="target_pickListUsers" class="form-select" size="10" multiple>
                                    @foreach ($listTargetAdmUsers as $user)
                                        <option value="{{ $user->getIdAttribute() }}">{{ $user->getNameAttribute() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 form-group mb-2">
                    <label for="pickListPages">{{ $messages["editAdmProfile.pickListPages"] }}</label>
                    <div class="row ms-1">
                        <div class="col-md-5">
                            <div class="row">
                                <input type="text" class="form-control" id="edtSource_pickListPages" maxlength="20" />
                                <input class="form-control" type="text" placeholder="{{ $messages["editAdmProfile.sourceCaptionPages"] }}" disabled>
                            </div>
                            <div class="row">
                                <select id="bufferSource_pickListPages" class="form-select" style="display: none">
                                    @foreach ($listSourceAdmPages as $itemPage)
                                        <option value="{{ $itemPage->getIdAttribute() }}">{{ $itemPage->getDescriptionAttribute() }}</option>
                                    @endforeach
                                </select>
                                <select id="source_pickListPages" class="form-select" size="10" multiple>
                                    @foreach ($listSourceAdmPages as $itemPage)
                                        <option value="{{ $itemPage->getIdAttribute() }}">{{ $itemPage->getDescriptionAttribute() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex justify-content-center align-items-center">
                            <div class="btn-group-vertical btn-group-sm">
                                <button type="button" class="btn btn-primary" id="btnRight_pickListPages">
                                    <span class="icon text-white-50"><i class="fa fa-angle-right"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnAllRight_pickListPages">
                                    <span class="icon text-white-50"><i class="fa fa-angle-double-right"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnLeft_pickListPages">
                                    <span class="icon text-white-50"><i class="fa fa-angle-left"></i></span>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnAllLeft_pickListPages">
                                    <span class="icon text-white-50"><i class="fa fa-angle-double-left"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <input type="text" class="form-control" id="edtTarget_pickListPages" maxlength="20" />
                                <input class="form-control" type="text" placeholder="{{ $messages["editAdmProfile.targetCaptionPages"] }}" disabled>
                            </div>
                            <div class="row">
                                <select id="bufferTarget_pickListPages" class="form-select" style="display: none">
                                    @foreach ($listTargetAdmPages as $itemPage)
                                        <option value="{{ $itemPage->getIdAttribute() }}">{{ $itemPage->getDescriptionAttribute() }}</option>
                                    @endforeach
                                </select>
                                <select asp-for="AdmPages" id="target_pickListPages" class="form-select" size="10" multiple>
                                    @foreach ($listTargetAdmPages as $itemPage)
                                        <option value="{{ $itemPage->getIdAttribute() }}">{{ $itemPage->getDescriptionAttribute() }}</option>
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

<script src="/static/js/admin/admProfile/editAdmProfile.js"></script>

@endsection
