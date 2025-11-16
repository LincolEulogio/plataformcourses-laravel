<x-instructor-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
                Actualizar Curso: <span class="text-gray-600 dark:text-gray-200">{{ $course->title }}</span>
            </h2>
            <a href="{{ route('instructor.courses.index') }}"
                class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center mt-4 md:mt-0">
                <span class="mr-2"><i class="fa-solid fa-arrow-rotate-left"></i></span>
                Volver a Cursos
            </a>
        </div>
    </x-slot>

    <x-contenido class="py-6" width="7xl">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <aside class="col-span-12 md:col-span-4 space-y-8 p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    <h3
                        class="text-xl font-semibold text-gray-700 dark:text-white border-l-4 border-blue-500 pl-3 mb-1">
                        Editar Información del Curso:
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">Modifica los datos del curso según sea
                        necesario.</p>
                </div>
                <div>
                    <h3
                        class="text-xl font-semibold text-gray-700 dark:text-white border-l-4 border-blue-500 pl-3 mb-1">
                        Video Promocional:
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">Modifica el video promocional del curso según
                        sea necesario.</p>
                </div>
                <div>
                    <h3
                        class="text-xl font-semibold text-gray-700 dark:text-white border-l-4 border-blue-500 pl-3 mb-1">
                        Imagen Publicidad:
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">Modifica la imagen de publicidad del curso según
                        sea necesario.</p>
                </div>
                <div>
                    <h3
                        class="text-xl font-semibold text-gray-700 dark:text-white border-l-4 border-blue-500 pl-3 mb-1">
                        Metas del Curso:
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">Modifica las metas del curso según sea
                        necesario.</p>
                </div>
                <div>
                    <h3
                        class="text-xl font-semibold text-gray-700 dark:text-white border-l-4 border-blue-500 pl-3 mb-1">
                        Requerimientos del Curso:
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">Modifica los requerimientos del curso según sea
                        necesario.</p>
                </div>
                <div>
                    <h3
                        class="text-xl font-semibold text-gray-700 dark:text-white border-l-4 border-blue-500 pl-3 mb-1">
                        Lecciones del Curso:
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">Modifica las lecciones del curso según sea
                        necesario.</p>
                </div>
                <div>
                    <h3
                        class="text-xl font-semibold text-gray-700 dark:text-white border-l-4 border-blue-500 pl-3 mb-1">
                        Mensajes:
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">Modifica los mensajes del curso según sea
                        necesario.</p>
                </div>
                <div>
                    <h3
                        class="text-xl font-semibold text-gray-700 dark:text-white border-l-4 border-blue-500 pl-3 mb-1">
                        Cupones:
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs">Modifica los cupones del curso según sea
                        necesario.</p>
                </div>
            </aside>
            <section
                class="col-span-12 md:col-span-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h2
                        class="text-gray-600 dark:text-white text-2xl font-semibold mb-4 border-b-2 border-blue-500 py-2">
                        Información del Curso:</h2>

                    <x-validation-errors class="mb-4" />

                    <div class="flex flex-col">
                        <div>
                            <x-label for="title" value="Nombre del Curso" class="mb-2" />
                            <x-input for="title" placeholder="Nombre del Curso" name="title" class="mb-2 w-full"
                                value="{{ old('title', $course->title) }}" id="title"
                                oninput="generateSlug(this.value)" />
                        </div>
                    </div>
                    <div class="flex flex-col mt-4">
                        <div>
                            <x-label for="slug" value="Slug del Curso" class="mb-2" />
                            <x-input for="slug" placeholder="Slug del Curso" name="slug" class="mb-2 w-full"
                                value="{{ old('slug', $course->slug) }}" id="slug" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-label for="category_id" value="Categoría" class="mb-2" />
                            <x-select name="category_id" id="category_id" required>
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Seleccione una
                                    categoría</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }} " {{ old('category_id', $course->category_id) ==
                                    $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </x-select>
                        </div>

                        <div>
                            <x-label for="level_id" value="Nivel" class="mb-2" />
                            <x-select name="level_id" id="level_id" required>
                                <option value="" disabled {{ old('level_id') ? '' : 'selected' }}>Seleccione un nivel
                                </option>
                                @foreach ($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id', $course->level_id) == $level->id ?
                                    'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                                @endforeach
                            </x-select>
                        </div>

                        <div>
                            <x-label for="price_id" value="Precio" class="mb-2" />
                            <x-select name="price_id" id="price_id" required>
                                <option value="" disabled {{ old('price_id') ? '' : 'selected' }}>Seleccione un
                                    precio</option>
                                @foreach ($prices as $price)
                                <option value="{{ $price->id }}" {{ old('price_id', $course->price_id) == $price->id ?
                                    'selected' : '' }}>
                                    @if ($price->value == 0)
                                    Gratis
                                    @else
                                    {{ $price->value }} USD (nivel {{ $loop->index }})
                                    @endif
                                </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mt-6">

                        {{-- Label --}}
                        <x-label for="file" value="Imagen del Curso"
                            class="mb-2 font-semibold text-gray-800 dark:text-gray-200" />

                        {{-- Zona de subida --}}
                        <label for="file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed 
               border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer 
               hover:border-blue-400 transition p-4 bg-gray-50 dark:bg-gray-800/50">
                            <div class="flex flex-col items-center">
                                <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none"
                                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-9 3v-13m0 0L7.5 9m4.5-5.5L16.5 9" />
                                </svg>
                                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                                    Haz clic para subir o arrastra una imagen
                                </p>
                            </div>
                            <x-input type="file" name="file" id="file" class="hidden" />
                        </label>

                        {{-- Imagen actual --}}
                        <div class="my-6">
                            <p class="text-gray-700 dark:text-gray-300 font-medium mb-2">Imagen Actual:</p>
                            <div
                                class="w-64 rounded-xl overflow-hidden shadow-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                                <img src="{{ $course->image ?? '#' }}" alt="Imagen del Curso"
                                    class="w-full h-auto object-cover">
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col md:flex-row md:max-w-sm gap-4 mt-4">
                        <x-button class="w-full text-center justify-center">
                            <span class="mr-2"><i class="fa-regular fa-floppy-disk"></i></span>
                            Actualizar
                        </x-button>
                        <x-button class="w-full text-center justify-center">
                            <span class="mr-2"><i class="fa-solid fa-x"></i></span>
                            Cancelar
                        </x-button>
                    </div>
                </form>
            </section>
        </div>
    </x-contenido>

</x-instructor-layout>

<script>
    // Función para generar el slug automáticamente
    function generateSlug(text) {
        // Convierte a minúsculas
        let slug = text.toLowerCase();

        // Elimina acentos y caracteres diacríticos
        slug = slug.normalize('NFD').replace(/[\u0300-\u036f]/g, '');

        // Reemplaza espacios y caracteres especiales por guiones
        slug = slug.replace(/[^a-z0-9]+/g, '-');

        // Elimina guiones al inicio y final
        slug = slug.replace(/^-+|-+$/g, '');

        // Actualiza el campo slug
        document.getElementById('slug').value = slug;
    }

</script>