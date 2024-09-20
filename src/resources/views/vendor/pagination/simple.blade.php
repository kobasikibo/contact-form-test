<!DOCTYPE html>
@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled">&lt;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
        @endif

        {{-- Pagination Elements --}}
        @php
            $start = $paginator->currentPage() - 2;
            $end = $paginator->currentPage() + 2;

            if ($start < 1) {
                $end += abs($start) + 1;
                $start = 1;
            }

            if ($end > $paginator->lastPage()) {
                $start -= ($end - $paginator->lastPage());
                $end = $paginator->lastPage();
            }

            if ($start < 1) {
                $start = 1;
            }
        @endphp

        {{-- Array Of Links --}}
        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $paginator->currentPage())
                <span class="active">{{ $page }}</span>
            @else
                <a href="{{ $paginator->url($page) }}">{{ $page }}</a>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
        @else
            <span class="disabled">&gt;</span>
        @endif
    </nav>
@endif