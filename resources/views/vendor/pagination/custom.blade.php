    
@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
        {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled page-link" aria-disabled="true" aria-label="Previous">
                    
                        <span aria-hidden="true">&lt;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&lt;</span>
                    </a>
                </li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled page-link" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item page-link active" aria-current="page"><span>{{$page}}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" data-type="1" href="{{$url}}">{{$page}}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            
            
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next" data-type="1">
                    <span aria-hidden="true">&gt;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled page-link" aria-disabled="true" aria-label="Next">
                        
                <span aria-hidden="true">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif