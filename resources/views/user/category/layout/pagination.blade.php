<nav>
    <ul class="pagination pagination-primary  justify-content-center">
        @if (request('show') == 'all')
        @else
            @if ($results->onFirstPage())
                <li class="page-item disabled"><a class="page-link" href="#">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $results->previousPageUrl() }}">
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a></li>
            @endif
            @foreach(range(1, $results->lastPage()) as $i)
                @if($i >= $results->currentPage() - 2 && $i <= $results->currentPage() + 2)
                    @if ($i == $results->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $results->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if ($results->currentPage() == $results->lastPage())
                <li class="page-item disabled"><a class="page-link" href="#">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a></li>
            @else
                <li class="page-item "><a class="page-link" href="{{ $results->nextPageUrl() }}">
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a></li>
            @endif
        @endif
    </ul>
</nav>
