<nav aria-label="Page navigation ">
    @if ($paginator->lastPage() > 1)
    <ul class="pagination mb-0">
        <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}">التالي</a>
        </li>
        @for ($i = $paginator->lastPage() ; $i >= 1 ; $i--)
        <li class=" page-item  {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a class="page-link" href=" {{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
        @endfor

        <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->url(1) }}">السابق</a>
        </li>
    </ul>
    @endif
</nav>
