@php
    $links = [
        [
            'header' => 'Admnistración',
        ],
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-house',
            'route' => route('admin.dashboard'),
            'active' => true,
        ],
        [
            'name' => 'Cursos',
            'icon' => 'fa-solid fa-book',
            'active' => false,
            'submenu' => [
                [
                    'name' => 'Listado de Cursos',
                    'route' => '#',
                    'active' => false,
                    'icon' => 'fa-solid fa-book',
                ],
                [
                    'name' => 'Nuevo Curso',
                    'route' => '#',
                    'active' => false,
                    'icon' => 'fa-solid fa-book',
                ],
            ],
        ],
    ];
@endphp

<aside id="top-bar-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-full pt-16 transition-all duration-300 ease-in-out transform -translate-x-full bg-white/95 backdrop-blur-sm border-r border-gray-100 shadow-sm sm:translate-x-0"
    :class="{ 'translate-x-0': open, '-translate-x-full': !open }" aria-label="Sidebar">
    <div class="h-full px-4 py-6 overflow-y-auto">

        <nav class="space-y-1">
            <ul>
                @foreach ($links as $link)
                    <li>
                        @isset($link['header'])
                            <span
                                class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 group">
                                {{ $link['header'] }}
                            </span>
                        @else
                            @if (isset($link['submenu']))
                                {{-- Mostrar como dropdown si tiene submenu --}}
                                <div x-data="{ open: {{ $link['active'] ? 'true' : 'false' }} }">
                                    <button @click="open = !open"
                                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 group {{ $link['active'] ?? false ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        <div class="flex items-center">
                                            <i class="{{ $link['icon'] ?? '' }} mr-3"></i>
                                            <span>{{ $link['name'] }}</span>
                                        </div>
                                        <i class="fas fa-chevron-right text-xs transform transition-transform duration-200"
                                            :class="{ 'rotate-90': open }"></i>
                                    </button>
                                    <ul class="ml-4" x-show="open" x-transition x-cloak>
                                        @foreach ($link['submenu'] as $submenu)
                                            <li>
                                                <a href="{{ $submenu['route'] ?? '#' }}"
                                                    class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ $submenu['active'] ?? false ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                                    <i
                                                        class="{{ $submenu['icon'] ?? 'fas fa-angle-right' }} mr-3 text-xs"></i>
                                                    {{ $submenu['name'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                {{-- Mostrar como enlace normal si no hay submenú --}}
                                <a href="{{ $link['route'] ?? '#' }}"
                                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 group {{ $link['active'] ?? false ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="{{ $link['icon'] ?? '' }} mr-3"></i>
                                    {{ $link['name'] }}
                                </a>
                            @endif
                        @endisset
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    <div class="absolute bottom-0 left-0 right-0 p-4 bg-white/80 backdrop-blur-sm border-t border-gray-100">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <img class="w-8 h-8 rounded-full"
                    src="https://ui-avatars.com/api/?name=User&background=6366f1&color=fff" alt="User avatar">
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>
</aside>
