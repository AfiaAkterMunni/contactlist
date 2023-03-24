@if ($paginator->hasPages())
    <div class="row">
        <div class="col-md-12">
            <nav class="pgn">
                <ul>
                    <li>
                        @if ($paginator->onFirstPage())
                            <span class="pgn__prev previous-link-disable">Prev</span>
                        @else
                            <span  class="pgn__prev">
                                <a href="{{$paginator->previousPageUrl()}}" class="previous-link">Prev</a>
                            </span>
                        @endif
                    </li>
                    @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                        <li>
                            <a
                                class="pgn__num @if ($paginator->currentPage() == $page) current @endif"
                                href="{{ $paginator->url($page) }}"
                            >
                                {{ $page }}
                            </a>
                        </li>
                    @endfor
                    <li>
                        @if ($paginator->hasMorePages())
                            <span class="pgn__next">
                                <a href="{{$paginator->nextPageUrl()}}" class="next-link">Next</a>
                            </span>
                        @else
                            <span class="pgn__next previous-link-disable">Next</span>
                        @endif
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endif