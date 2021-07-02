@extends('layout')

@section('title')
Edit Parameter Categories
@endsection

@section('content')

<form id="formEditAdmParameterCategory" style="padding: 5px;" method="post" action="/admParameterCategory/save">

    @csrf

    <div class="card">
        <div class="card-header" style="font-weight: bold;font-size: large;">
            {{ $messages["editAdmParameterCategory.title"] }}
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
                <div class="col-md-4 form-group mb-3">
                    <input type="hidden" id="id" name="id" value="{{ $model->getIdAttribute() }}" />

                    <label for="description">{{ $messages["editAdmParameterCategory.description"] }}</label>
                    <input type="text" class="form-control" id="description" name="description"
                        maxlength="64" required="required" value="{{ $model->getDescriptionAttribute() }}" />
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label for="order">{{ $messages["editAdmParameterCategory.order"] }}</label>
                    <input type="text" class="form-control" id="order" name="order"
                        maxlength="64" required="required" value="{{ $model->getOrderAttribute() }}" />
                </div>
            </div>

        </div>
    </div>

    <br>
    <br>
</form>

<script src="/static/js/admin/admParameterCategory/editAdmParameterCategory.js"></script>

@endsection
