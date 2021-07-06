@extends('layout')

@section('title')
Edit User
@endsection

@section('content')

<form id="formEditAdmUser" style="padding: 5px;" method="post" action="/admUser/save">

    @csrf

    <div class="card">
        <div class="card-header"
             style="font-weight: bold;font-size: large;">
             {{ $messages["editAdmUser.title"] }}
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
                    onclick="editAdmUser.btnCancelClick('{{ route('listAdmUser') }}');">
                    <span class="icon text-white-50">
                        <i class="fa fa-times-circle"></i>
                    </span>
                    <span class="text">{{ $messages["button.cancel"] }}</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-4 form-group mb-2">
                    <input type="hidden" id="id" name="id" value="{{ $model->getIdAttribute() }}" />

                    <label for="login">{{ $messages["editAdmUser.login"] }}</label>
                    <input type="text" class="form-control" id="login" name="login"
                        maxlength="64" required="required" value="{{ $model->getLoginAttribute() }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 form-group mb-2">
                    <label for="name">{{ $messages["editAdmUser.name"] }}</label>
                    <input type="text" class="form-control" id="name" name="name"
                        maxlength="64" required="required" value="{{ $model->getNameAttribute() }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 form-group mb-2">
                    <label for="email">{{ $messages["editAdmUser.email"] }}</label>
                    <input type="text" class="form-control" id="email" name="email"
                        maxlength="64" required="required" value="{{ $model->getEmailAttribute() }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="active" name="active"
                            value="{{ $model->getActiveAttribute() }}" />
                        <label class="form-check-label" for="active">
                            &nbsp;{{ $messages["editAdmUser.active"] }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="/static/js/admin/admUser/editAdmUser.js"></script>

@endsection
