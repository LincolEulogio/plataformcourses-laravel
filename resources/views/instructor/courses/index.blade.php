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
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3 md:p-6">
            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            {{-- Lista de cursos --}}
            @if ($courses->isEmpty())
            <p class="text-gray-700 dark:text-gray-300">No tienes cursos creados aún.</p>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-5">

                @foreach ($courses as $course)
                <div class="group relative bg-white dark:bg-gray-900/80 border border-gray-200 dark:border-gray-700
           rounded-2xl overflow-hidden shadow-[0_4px_12px_rgba(0,0,0,0.05)]
           hover:shadow-[0_8px_20px_rgba(0,0,0,0.10)]
           transition-all duration-300">

                    {{-- IMAGEN --}}
                    <div class="relative w-full h-36 overflow-hidden">
                        @if ($course->image)
                        <img src="{{ $course->image }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]">
                        @else
                        <div class="w-full h-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                            <i class="fa-solid fa-film text-gray-300 text-3xl"></i>
                        </div>
                        @endif

                        {{-- ESTADO --}}
                        <div class="absolute top-2 right-2">
                            @switch($course->status->name)
                            @case('BORRADOR')
                            <span class="px-2 py-[2px] text-[10px] rounded-full bg-red-100 text-red-700">{{
                                $course->status->name }}</span>
                            @break

                            @case('PENDIENTE')
                            <span class="px-2 py-[2px] text-[10px] rounded-full bg-yellow-100 text-yellow-700">{{
                                $course->status->name }}</span>
                            @break

                            @case('PUBLICADO')
                            <span class="px-2 py-[2px] text-[10px] rounded-full bg-green-100 text-green-700">{{
                                $course->status->name }}</span>
                            @break
                            @endswitch
                        </div>
                    </div>

                    {{-- CONTENIDO --}}
                    <div class="p-4">

                        {{-- BADGE DE ESTRELLAS --}}
                        <div class="mb-1 flex items-center">
                            <span
                                class="px-2 py-[2px] text-xs font-medium rounded-full bg-yellow-100 text-yellow-700 flex items-center gap-1 mb-2">
                                <i class="fa-solid fa-star text-yellow-500"></i> 3.5
                            </span>
                        </div>

                        {{-- Título izquierda + Precio derecha --}}
                        <div class="flex items-center justify-between mb-1">
                            <a href="{{ route('instructor.courses.show', $course) }}" class="text-lg font-semibold text-gray-900 dark:text-white line-clamp-1 tracking-tight">
                                {{ $course->title }}
                            </a>

                            @if ($course->price->value == 0)
                            <span class="px-2 py-[1px] text-md font-medium rounded-full bg-green-50 text-green-600">
                                Gratis
                            </span>
                            @else
                            <span class="px-2 py-[1px] text-md font-medium rounded-full bg-blue-50 text-blue-600">
                                ${{ $course->price->value }}
                            </span>
                            @endif
                        </div>

                        {{-- Categoría + nivel --}}
                        <p class="text-[12px] text-gray-500 dark:text-gray-400 mb-2">
                            {{ $course->category->name }} •
                            {{ $course->user ? $course->user->name : 'Usuario no disponible' }}
                        </p>

                        {{-- Inscritos + íconos estáticos (abajo a la derecha) --}}
                        <div
                            class="flex items-center justify-between text-[12px] text-gray-600 dark:text-gray-300 mt-3">

                            {{-- Estudiantes --}}
                            <span class="flex items-center space-x-1">
                                <i class="fa-solid fa-users text-gray-400"></i>
                                <span class="text-sm">23</span>
                            </span>

                            {{-- Íconos (estáticos + compactos tipo Apple) --}}
                            <div class="flex items-center space-x-3">
                                {{-- Editar --}}
                                <a href="{{ route('instructor.courses.edit', $course) }}"
                                    class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 text-[15px] transition">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('instructor.courses.destroy', $course) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar este curso?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-gray-600 dark:text-gray-300 hover:text-red-600 text-[15px] transition">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Paginación --}}
        @if ($courses->hasPages())
        <div class="mt-6">
            {{ $courses->links() }}
        </div>
        @endif
    </x-contenido>
</x-instructor-layout>