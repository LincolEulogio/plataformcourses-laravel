@if (count($breadcrumbs) > 0)
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @foreach ($breadcrumbs as $index => $breadcrumb)
                <li class="inline-flex items-center">
                    @if ($index === 0)
                        {{-- First item with home icon --}}
                        <a href="{{ $breadcrumb['url'] }}"
                            class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand cursor-pointer hover:text-blue-600">
                            <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                            </svg>
                            {{ $breadcrumb['name'] }}
                        </a>
                    @else
                        {{-- Other items with arrow --}}
                        <div class="flex items-center">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body mx-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m9 5 7 7-7 7" />
                            </svg>
                            @if ($index < count($breadcrumbs) - 1)
                                <a href="{{ $breadcrumb['url'] }}"
                                    class="text-sm font-medium text-body hover:text-fg-brand cursor-pointer hover:text-blue-600">
                                    {{ $breadcrumb['name'] }}
                                </a>
                            @else
                                <span class="text-sm font-medium text-body-subtle text-gray-500">
                                    {{ $breadcrumb['name'] }}
                                </span>
                            @endif
                        </div>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
