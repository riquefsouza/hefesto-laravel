@extends('layout')

@section('title')
Edit Menu
@endsection

@section('content')

<form id="formEditAdmMenu" style="padding: 5px;" method="post" action="/admPage/save">

    @csrf

    <div class="card">
        <div class="card-header"
             style="font-weight: bold;font-size: large;">
             {{ $messages["editAdmMenu.title"] }}
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
                    onclick="editAdmMenu.btnCancelClick('{{ route('listAdmMenu') }}');">
                    <span class="icon text-white-50">
                        <i class="fa fa-times-circle"></i>
                    </span>
                    <span class="text">{{ $messages["button.cancel"] }}</span>
                </button>
            </div>

            <div class="row">
                <div class="col-md-4 form-group mb-2">
                    <input type="hidden" id="id" name="id" value="{{ $model->getIdAttribute() }}" />

                    <label for="idPage">{{ $messages["editAdmMenu.page"] }}</label>
                    <select id="idPage" name="idPage" class="form-select">
                        @foreach ($listAdmPages as $itemPage)
                            @if ($model != null && ($itemPage->getIdAttribute() === $model->getIdPageAttribute()))
                                <option value="{{ $itemPage->getIdAttribute() }}" selected>{{ $itemPage->getDescriptionAttribute() }}</option>
                            @else
                                <option value="{{ $itemPage->getIdAttribute() }}">{{ $itemPage->getDescriptionAttribute() }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group mb-2">
                    <label for="description">{{ $messages["editAdmMenu.description"] }}</label>
                    <input type="text" class="form-control" id="description" name="description"
                        maxlength="255" required="required" value="{{ $model->getDescriptionAttribute() }}" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group mb-2">
                    <label for="idMenuParent">{{ $messages["editAdmMenu.menuParent"] }}</label>
                    <select id="idMenuParent" name="idMenuParent" class="form-select">
                        @foreach ($listAdmMenuParents as $itemMenuParent)
                            @if ($model != null && ($itemMenuParent->getIdAttribute() === $model->getIdMenuParentAttribute()))
                                <option value="{{ $itemMenuParent->getIdAttribute() }}" selected>{{ $itemMenuParent->getDescriptionAttribute() }}</option>
                            @else
                                <option value="{{ $itemMenuParent->getIdAttribute() }}">{{ $itemMenuParent->getDescriptionAttribute() }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 form-group mb-2">
                    <label for="order">{{ $messages["editAdmMenu.order"] }}</label>
                    <input type="text" class="form-control" id="order" name="order"
                        maxlength="10" required="required" value="{{ $model->getOrderAttribute() }}" />
                </div>
            </div>

        </div>
    </div>

    <br>
    <br>
</form>

<script src="/static/js/admin/admMenu/editAdmMenu.js"></script>

@endsection
