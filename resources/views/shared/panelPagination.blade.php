<div class="row justify-content-center">
    <div class="col-md-auto">

        <ul class="pagination">
            <li class="{{ $model->Paging->PrevEnabledClass }}">
                <a class="page-link" href="{{ $Model->Paging->FirstPage }}" aria-label="First">
                    <span aria-hidden="true" style="font-size: small">|&lt;</span>
                </a>
            </li>
            <li class="{{ $model->Paging->PrevEnabledClass }}">
                <a class="page-link" href="{{ $Model->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            @foreach ($item as $model->Paging->Items)

                <block>
                    @if ($item->PageItemType == $BasePageItemType->PAGE)

                        @if ($item->Index == $model->Paging->PageNumber)
                            <li class="page-item active">
                                <a class="page-link" href="{{ $model->Paging->CurrentPage($item->Index) }}">{{ $item->Index }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $model->Paging->CurrentPage($item->Index) }}">{{ $item->Index }}</a>
                            </li>
                        @endif

                    @endif

                    @if ($item->PageItemType == $BasePageItemType->DOTS)

                        <li class="page-item disabled">
                            <a class="page-link" href="#">...</a>
                        </li>

                    @endif
                </block>

            @endforeach

            <li class="{{ $model->Paging->NextEnabledClass }}" aria-label="Next">
                <a class="page-link" href="{{ $model->nextPageUrl() }}">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <li class="{{ $model->Paging->NextEnabledClass }}" aria-label="Last">
                <a class="page-link" href="{{ $model->Paging->LastPage }}">
                    <span aria-hidden="true" style="font-size: small">&gt;|</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="col-md-auto">
        <select class="form-select" id="cmbPaginationSize">
            @if ($model->count() == 10) { <option value="10" selected>10</option> } else { <option value="10">10</option> }
            @if ($model->count() == 20) { <option value="20" selected>20</option> } else { <option value="20">20</option> }
            @if ($model->count() == 30) { <option value="30" selected>30</option> } else { <option value="30">30</option> }
            @if ($model->count() == 50) { <option value="50" selected>50</option> } else { <option value="50">50</option> }
            @if ($model->count() == 100) { <option value="100" selected>100</option> } else { <option value="100">100</option> }
        </select>

    </div>
</div>
