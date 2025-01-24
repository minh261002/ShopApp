@push('styles')
    <style>
        .active>.page-link,
        .page-link.active {
            background-color: #d63939;
            border-color: #d63939 !important;
        }

        .page-link:focus {
            box-shadow: none;
        }
    </style>
@endpush

<ul class="pagination">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="page-link" href="#">
                <i class="ti ti-chevrons-left"></i>
            </a></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"> <i
                    class="ti ti-chevrons-left"></i>
            </a></li>
    @endif

    <!-- First Page Link -->
    @if ($paginator->currentPage() > 2)
        <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
    @endif

    <!-- Ellipsis before the current page -->
    @if ($paginator->currentPage() > 3)
        <li class="page-item"><a class="page-link" href="#">...</a></li>
    @endif

    <!-- Pages in the middle -->
    @foreach (range(1, $paginator->lastPage()) as $page)
        @if ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1)
            <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
            </li>
        @endif
    @endforeach

    <!-- Ellipsis after the current page -->
    @if ($paginator->currentPage() < $paginator->lastPage() - 2)
        <li class="page-item"><a class="page-link" href="#">...</a></li>
    @endif

    <!-- Last Page Link -->
    @if ($paginator->currentPage() < $paginator->lastPage() - 1)
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                {{ $paginator->lastPage() }}
            </a></li>
    @endif

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"> <i
                    class="ti ti-chevrons-right"></i>
            </a></li>
    @else
        <li class="page-item disabled"><a class="page-link" href="#"> <i class="ti ti-chevrons-right"></i>
            </a></li>
    @endif
</ul>
