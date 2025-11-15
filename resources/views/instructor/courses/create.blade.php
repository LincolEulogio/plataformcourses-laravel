<x-instructor-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Crear Nuevo Curso
            </h2>
            <a href="{{ route('instructor.courses.index') }}"
                class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center mt-4 md:mt-0">
                <span class="mr-2"><i class="fa-solid fa-arrow-rotate-left"></i></span>
                Volver a Cursos
            </a>
        </div>
    </x-slot>

    <x-contenido class="py-12" width="4xl">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p class="text-gray-700 dark:text-white text-md font-semibold py-2">Completa la información para crear
                    el nuevo curso</p>

                <x-validation-errors class="mb-4" />


                <div class="flex flex-col mt-4">
                    <div>
                        <x-label for="title" value="Nombre del Curso" class="mb-2" />
                        <x-input for="title" placeholder="Nombre del Curso" name="title" class="mb-2 w-full"
                            value="{{ old('title') }}" id="title" oninput="generateSlug(this.value)" />
                    </div>
                </div>
                <div class="flex flex-col mt-4">
                    <div>
                        <x-label for="slug" value="Slug del Curso" class="mb-2" />
                        <x-input for="slug" placeholder="Slug del Curso" name="slug" class="mb-2 w-full"
                            value="{{ old('slug') }}" id="slug" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-label for="category_id" value="Categoría" class="mb-2" />
                        <x-select name="category_id" id="category_id" required>
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Seleccione una
                                categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                <option value="{{ $level->id }}"
                                    {{ old('level_id') == $level->id ? 'selected' : '' }}>
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
                                <option value="{{ $price->id }}"
                                    {{ old('price_id') == $price->id ? 'selected' : '' }}>
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
                <div class="flex flex-col md:flex-row md:max-w-sm gap-4 mt-4">
                    <x-button class="w-full text-center justify-center">
                        <span class="mr-2"><i class="fa-regular fa-floppy-disk"></i></span>
                        Crear Curso
                    </x-button>
                    <x-button class="w-full text-center justify-center">
                        <span class="mr-2"><i class="fa-solid fa-x"></i></span>
                        Cancelar
                    </x-button>
                </div>
            </form>
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
