@extends('layout')

@section('title')
Edit Parameters
@endsection

@section('content')

<form id="formEditAdmParameter" style="padding: 5px;" method="post" action="{{ route("saveAdmParameter") }}">

    @csrf

    <div class="card">
        <div class="card-header" style="font-weight: bold;font-size: large;">
            {{ $messages["editAdmParameter.title"] }}
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
                    onclick="editAdmParameter.btnCancelClick('{{ route('listAdmParameter') }}');">
                    <span class="icon text-white-50">
                        <i class="fa fa-times-circle"></i>
                    </span>
                    <span class="text">{{ $messages["button.cancel"] }}</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-4 form-group mb-2">
                    <input type="hidden" id="id" name="id" value="{{ $model->getIdAttribute() }}" />

                    <label for="idParameterCategory">{{ $messages["editAdmParameter.category"] }}</label>
                    <select for="idParameterCategory" name="idParameterCategory" class="form-select">
                        @foreach ($listAdmCategories as $itemCategory)
                            @if ($model != null && ($itemCategory->getIdAttribute() === $model->getIdParameterCategoryAttribute()))
                                <option value="{{ $itemCategory->getIdAttribute() }}" selected>{{ $itemCategory->getDescriptionAttribute() }}</option>
                            @else
                                <option value="{{ $itemCategory->getIdAttribute() }}">{{ $itemCategory->getDescriptionAttribute() }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group mb-2">
                    <label for="code">{{ $messages["editAdmParameter.code"] }}</label>
                    <input type="text" class="form-control" id="code" name="code"
                        maxlength="64" required="required" value="{{ $model->getCodeAttribute() }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 form-group mb-2">
                    <label for="value">{{ $messages["editAdmParameter.value"] }}</label>
                    <textarea class="form-control" id="value" name="value" rows="6"
                        maxlength="4000" required="required"/>{{ $model->getValueAttribute() }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group mb-2">
                    <label for="description">{{ $messages["editAdmParameter.description"] }}</label>
                    <input type="text" class="form-control" id="description" name="description"
                        maxlength="255" required="required" value="{{ $model->getDescriptionAttribute() }}" />
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
</form>

<script src="/static/js/admin/admParameter/editAdmParameter.js"></script>

@endsection
