<div class="row justify-content-center">
    <div class="col-md-auto">

        <ul class="pagination">

            <li class="{{ $model->currentPage() === 1 ? 'page-item disabled' : 'page-item' }}">
                <a class="page-link" href="{{ $model->url(1) }}" aria-label="First">
                    <span aria-hidden="true" style="font-size: small">|&lt;</span>
                </a>
            </li>
            <li class="{{ $model->currentPage() === 1 ? 'page-item disabled' : 'page-item' }}">
                <a class="page-link" href="{{ $model->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            @for ($i = 1; $i <= $model->lastPage(); $i++)

                <block>

                    @if ($i === $model->currentPage())
                        <li class="page-item active">
                            <a class="page-link" href="{{ $model->url($i) }}">{{ $i }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $model->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif

                </block>

            @endfor

            <li class="{{ $model->currentPage() === $model->lastPage() ? 'page-item disabled' : 'page-item' }}" aria-label="Next">
                <a class="page-link" href="{{ $model->nextPageUrl() }}">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <li class="{{ $model->currentPage() === $model->lastPage() ? 'page-item disabled' : 'page-item' }}" aria-label="Last">
                <a class="page-link" href="{{ $model->url($model->lastPage()) }}">
                    <span aria-hidden="true" style="font-size: small">&gt;|</span>
                </a>
            </li>
        </ul>

    </div>
</div>
