<x-instructor-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
                Información del Curso : <span class="text-gray-200">{{ $course->title }}</span>
            </h2>
            <a href="{{ route('instructor.courses.index') }}"
                class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center mt-4 md:mt-0">
                <span class="mr-2"><i class="fa-solid fa-arrow-rotate-left"></i></span>
                Volver a Cursos
            </a>
        </div>
    </x-slot>

    <x-contenido class="py-12" width="4xl">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 
            rounded-2xl shadow-md overflow-hidden transition hover:shadow-lg">
            <div class="flex flex-col md:flex-row">
                <!-- Imagen -->
                <div class="md:w-1/2">
                    <img src="{{ $course->image }}" alt="{{ $course->title }}"
                        class="w-full h-64 md:h-full object-cover">
                </div>
                <!-- Contenido -->
                <div class="md:w-1/2 p-6 flex flex-col justify-between">
                    <div>
                        <h3
                            class="px-2 py-[2px] text-xs font-medium rounded-full bg-yellow-100 text-yellow-700 mb-2 block w-max">
                            <i class="fa-solid fa-star text-yellow-500"></i> 3.5
                        </h3>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white leading-tight">
                            {{ $course->title }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Creado el: {{ $course->created_at->format('d/m/Y') }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mt-4">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nisi blanditiis quod illum rerum nesciunt molestiae inventore.
                        </p>
                    </div>
                    <div class="mt-6 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Categoría:</span>
                            <span class="text-blue-500 font-medium">{{ $course->category->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Nivel:</span>
                            <span class="text-purple-400 font-medium">{{ $course->level->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Precio:</span>
                            @if ($course->price->value == 0)
                            <span class="text-green-500 font-bold">Gratis</span>
                            @else
                            <span class="text-red-500 font-bold">${{ $course->price->value }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-contenido>
</x-instructor-layout>