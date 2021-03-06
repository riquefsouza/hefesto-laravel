@extends('layout')

@section('title')
List Parameter Categories
@endsection

@section('content')

<form id="formListAdmParameterCategory" style="padding: 5px;" action="{{ route("listAdmParameterCategory") }}" method="get">

    <div class="card">
        <div class="card-header"
             style="font-weight: bold;font-size: large;">
            <span id="formTitle">{{ $messages["listAdmParameterCategory.title"] }}</span>
        </div>
        <div class="card-body">
            <div class="row">
                @include('shared.panelReport', ['listReportType' => $listReportType])
            </div>
        </div>
    </div>

    <div class="form-actions" style="margin:5px 0;">
        <button type="button" class="btn btn-primary" id="btnExport">
            <span class="icon text-white-50">
                <i class="fa fa-file"></i>
            </span>
            <span class="text">{{ $messages["button.export"] }}</span>
        </button>
        <button type="button" class="btn btn-success" id="btnAdd">
            <span class="icon text-white-50">
                <i class="fa fa-plus-circle"></i>
            </span>
            <span class="text">{{ $messages["button.add"] }}</span>
        </button>
        <button type="button" class="btn btn-warning" id="btnEdit">
            <span class="icon text-white-50">
                <i class="fa fa-chevron-circle-up"></i>
            </span>
            <span class="text">{{ $messages["button.edit"] }}</span>
        </button>
        <button type="button" class="btn btn-danger" id="btnPreDelete">
            <span class="icon text-white-50">
                <i class="fa fa-minus-circle"></i>
            </span>
            <span class="text">{{ $messages["button.delete"] }}</span>
        </button>
        <button type="button" class="btn btn-primary" id="btnBack">
            <span class="icon text-white-50">
                <i class="fa fa-arrow-circle-left"></i>
            </span>
            <span class="text">{{ $messages["button.back"] }}</span>
        </button>
    </div>
</form>

    <form method="post">
        @csrf
        @method('DELETE')

        <div class="modal fade" id="dlgDeleteConfirmation" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><span>{{ $messages["dlgDeleteConfirmation.title"] }}</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $messages["dlgDeleteConfirmation.text"] }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" id="btnDelete" class="btn btn-primary" onclick="listAdmParameterCategory.btnDeleteClick(this.form)">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    @include('shared.panelPagination', ['model' => $model])

    <table class="table table-sm table-striped table-bordered" id="tableAdmParameterCategory" style="width: 100%">
        <thead>
            <tr>
                <th style="display: none">Id</th>
                <th onclick="listAdmParameterCategory.tableHeaderColumnClick(this, 1, 'Description');">Description  <i class='fas fa-sort-alpha-up fa-sm'></i></th>
                <th onclick="listAdmParameterCategory.tableHeaderColumnClick(this, 2, 'Order');">Order  <i class='fas fa-sort-alpha-up fa-sm'></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($model as $item)
                <tr id="{{ $item->getIdAttribute() }}" onclick="listAdmParameterCategory.tableRowClick(this);">
                    <td style="display: none">{{ $item->getIdAttribute() }}</td>
                    <td>{{ $item->getDescriptionAttribute() }}</td>
                    <td>{{ $item->getOrderAttribute() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <br>


<script src="/static/js/admin/admParameterCategory/listAdmParameterCategory.js"></script>

@endsection
