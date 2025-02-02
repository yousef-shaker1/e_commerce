@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ __('pagination.previous') }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        {{ __('pagination.previous') }}
                    </a>
                </li>
            @endif
<!-- أرقام الصفحات -->
@foreach(range(1, $paginator->lastPage()) as $page)
<li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
    <a href="{{ $paginator->url($page) }}" class="page-link">{{ $page }}</a>
</li>
@endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('pagination.next') }}</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ __('pagination.next') }}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
