@extends('layout')

@section('title')
Change Password
@endsection

@section('content')

<form id="formChangePassword" style="padding: 5px;" method="post" action="{{ route("saveChangePassword") }}">

    @csrf

    <div class="card">
        <div class="card-header" style="font-weight: bold;font-size: large;">
            {{ $messages["changePassword.title"] }}
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
                    onclick="hfsChangePassword.btnCancelClick('{{ route('showHome') }}');">
                    <span class="icon text-white-50">
                        <i class="fa fa-times-circle"></i>
                    </span>
                    <span class="text">{{ $messages["button.cancel"] }}</span>
                </button>
            </div>

            <div class="row">
                <p>As minimum requirements for user passwords, the following should be considered:</p>
                <ul>
                    <li>Minimum length of 8 characters;</li>
                    <li>
                        Presence of at least 3 of the 4 character classes below:
                        <ul>
                            <li>uppercase characters;</li>
                            <li>lowercase characters;</li>
                            <li>numbers;</li>
                            <li>special characters;</li>
                            <li>Absence of strings (eg: 1234) or consecutive identical characters (yyyy);</li>
                            <li>Absence of any username identifier, such as: John Silva - user: john.silva - password cannot contain "john" or "silva".</li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-6 form-group mb-2">

                    <input type="hidden" id="id" name="id" value="{{ $model->getIdAttribute() }}" />
                    <input type="hidden" id="name" name="name" value="{{ $model->getNameAttribute() }}" />
                    <input type="hidden" id="login" name="login" value="{{ $model->getLoginAttribute() }}" />
                    <input type="hidden" id="password" name="password" value="{{ $model->getPasswordAttribute() }}" />
                    <input type="hidden" id="email" name="email" value="{{ $model->getEmailAttribute() }}" />

                    <label for="currentPassword">{{ $messages["changePassword.currentPassword"] }}</label>
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                        required="required" maxlength="64" autocomplete="off" value="{{ $model->getCurrentPasswordAttribute() }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-2">
                    <label for="newPassword">{{ $messages["changePassword.newPassword"] }}</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                        required="required" maxlength="64" autocomplete="off" value="{{ $model->getNewPasswordAttribute() }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-2">
                    <label for="confirmNewPassword">{{ $messages["changePassword.confirmNewPassword"] }}</label>
                    <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword"
                        required="required" maxlength="64" autocomplete="off" value="{{ $model->getConfirmNewPasswordAttribute() }}" />
                </div>
            </div>

        </div>
    </div>

    <br>
    <br>
</form>

<script src="/static/js/hfsframework/hfsframework-changePassword.js"></script>

@endsection
