@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if (!$paginator->onFirstPage())
                <a wire:click="previousPage"
                    class="cursor-pointer font-poppins relative inline-flex items-center px-4 py-2 text-sm  text-gray-700 bg-white border border-gray-300 leading-5 rounded-md focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 hover:text-gray-600 hover:bg-gray-200">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a wire:click="nextPage" wire:loading.attr="disabled"
                    class="cursor-pointer font-poppins relative inline-flex items-center px-4 py-2 ml-3 text-sm  text-gray-700 bg-white border border-gray-300 leading-5 rounded-md focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 hover:text-gray-600 hover:bg-gray-200">
                    {!! __('pagination.next') !!}
                </a>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center lg:justify-between justify-center">
            <div class="lg:block hidden">
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    <span class="">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex">
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm  text-gray-700 bg-white border border-gray-300 cursor-default leading-5">
                                    {{ $element }}
                                  </span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-poppins  text-gray-600 bg-gray-100 border border-gray-300 cursor-default leading-5">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <a wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                                        class="cursor-pointer font-poppins relative inline-flex items-center px-4 py-2 -ml-px text-sm  text-gray-700 bg-white border border-gray-300 leading-5 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 hover:text-gray-600 hover:bg-gray-100"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </span>
            </div>
        </div>
    </nav>
@endif
