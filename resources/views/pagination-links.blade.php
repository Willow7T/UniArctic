<div>

    @if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="xl:absolute left-2 bottom-3 p-4 flex items-center gap-x-2">
        <div>
            @if ($paginator->onFirstPage())
                <span class="
                relative inline-flex items-center px-4 py-2 
                text-sm font-medium text-gray-500 bg-white border 
                border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('Previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="
                    relative inline-flex items-center px-4 py-2 text-sm 
                    font-medium text-gray-700 bg-white border 
                    border-gray-300 leading-5 hover:text-gray-500 
                    focus:z-10 focus:outline-none focus:border-blue-300 
                    focus:ring-1 focus:ring-blue-300 focus:ring-opacity-5 rounded-md">
                    {!! __('Previous') !!}
                </a>
            @endif
        </div>

        <div>
            @foreach (range(1, $paginator->lastPage()) as $page)
                @if ($page == $paginator->currentPage())
                    <span class="relative inline-flex items-center 
                    px-4 py-2 text-sm font-medium text-gray-500 
                    bg-white border border-gray-300 
                    cursor-default leading-5 rounded-md">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}" class="
                        relative inline-flex items-center 
                        px-4 py-2 text-sm font-medium 
                        text-gray-700 bg-white border border-gray-300 
                        leading-5 hover:text-gray-500 
                        focus:z-10 focus:outline-none focus:border-blue-300 
                        focus:ring-1 focus:ring-blue-300 focus:ring-opacity-5 rounded-md">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        </div>

        <div>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-blue-300 focus:ring-opacity-5 rounded-md">
                    {!! __('Next') !!}
                </a>
            @else
                <span class="
                relative inline-flex items-center px-4 py-2 
                text-sm font-medium text-gray-500 
                bg-white border border-gray-300 
                cursor-default leading-5 rounded-md">
                    {!! __('Next') !!}
                </span>
            @endif
        </div>
    </nav>
@endif

</div>