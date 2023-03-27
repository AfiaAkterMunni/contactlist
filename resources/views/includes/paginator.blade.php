@if ($paginator->hasPages())
    <div class="pagination-wrap pagination">
        @if ($paginator->onFirstPage())
            <span>< Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">< Prev</a>
        @endif
        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
            <a href="{{ $paginator->url($page) }}" class="@if ($paginator->currentPage() == $page) active @endif">{{$page}}</a>
        @endfor
        @if ($paginator->hasMorePages())
            <a href="{{$paginator->nextPageUrl()}}">Next ></a>
        @else
            <span>Next</span>
        @endif
    </div>
@endif