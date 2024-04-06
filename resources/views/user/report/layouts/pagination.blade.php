<nav>
    <ul class="pagination pagination-primary justify-content-center">
        @if (request('show') == 'all')
        @else
            @if ($transactions->onFirstPage())
                <li class="page-item disabled"><a class="page-link" href="#">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $transactions->previousPageUrl() }}">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a></li>
            @endif
            @foreach(range(1, $transactions->lastPage()) as $i)
                @if($i >= $transactions->currentPage() - 2 && $i <= $transactions->currentPage() + 2)
                    @if ($i == $transactions->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $transactions->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if ($transactions->currentPage() == $transactions->lastPage())
                <li class="page-item disabled"><a class="page-link" href="#">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a></li>
            @else
                <li class="page-item "><a class="page-link" href="{{ $transactions->nextPageUrl() }}">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a></li>
            @endif
        @endif
    </ul>
</nav>
