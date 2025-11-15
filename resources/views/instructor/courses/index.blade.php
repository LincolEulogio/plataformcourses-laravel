<x-instructor-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Lista de Cursos
            </h2>
            <a href="{{ route('instructor.courses.create') }}"
                class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center mt-4 md:mt-0">
                <span class="mr-2"><i class="fa-solid fa-plus"></i></span>
                Crear Nuevo Curso
            </a>
        </div>
    </x-slot>
    <x-contenido class="py-12" width="7xl">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($courses->isEmpty())
                <p class="text-gray-700 dark:text-white">No tienes cursos creados aún.</p>
            @else
                <!-- Vista Desktop: Tabla completa -->
                <div class="block w-full overflow-x-auto">
                    <div class="min-w-max">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        ID</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Imagen</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nombre</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell">
                                        Categoría</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">
                                        Nivel</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Precio</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Estado</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">
                                        Inscritos</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">
                                        Calificación</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($courses as $course)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $course->id }}</td>
                                        <td class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap">
                                            @if ($course->image)
                                                <img src="{{ $course->image }}" alt="{{ $course->title }}"
                                                    class="h-8 w-8 sm:h-10 sm:w-10 rounded-full object-cover">
                                            @else
                                                <div
                                                    class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                    <i class="fa-solid fa-film text-white text-xs"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ Str::limit($course->title, 20) }}
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 hidden sm:table-cell">
                                            {{ $course->category->name }}
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 hidden md:table-cell">
                                            {{ $course->level->name }}
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            @if ($course->price->value == 0)
                                                <span
                                                    class="inline-block bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded text-xs font-semibold">Gratis</span>
                                            @else
                                                <span
                                                    class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-2 py-1 rounded text-xs font-semibold">${{ $course->price->value }}</span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            @switch($course->status->name)
                                                @case('BORRADOR')
                                                    <span
                                                        class="bg-red-700 border border-red-600 text-red-200 text-xs font-medium px-1.5 py-1 rounded">{{ $course->status->name }}</span>
                                                @break

                                                @case('PENDIENTE')
                                                    <span
                                                        class="bg-yellow-700 border border-yellow-600 text-yellow-200 text-xs font-medium px-1.5 py-1 rounded">{{ $course->status->name }}</span>
                                                @break

                                                @case('PUBLICADO')
                                                    <span
                                                        class="bg-green-700 border border-green-600 text-green-200 text-xs font-medium px-1.5 py-1 rounded">{{ $course->status->name }}</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 hidden md:table-cell">
                                            <span class="inline-flex items-center"><i
                                                    class="fa-solid fa-users text-blue-500 mr-2"></i>23</span>
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 hidden lg:table-cell">
                                            <span class="inline-flex items-center"><i
                                                    class="fa-solid fa-star text-yellow-500 mr-2"></i>3.5</span>
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 space-x-2">
                                            <a href="{{ route('instructor.courses.edit', $course) }}"
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 transition inline-block mr-2">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('instructor.courses.destroy', $course) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('¿Estás seguro?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200 transition">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </x-contenido>
</x-instructor-layout>
