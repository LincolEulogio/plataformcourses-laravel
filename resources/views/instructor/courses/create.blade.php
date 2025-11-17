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
                {{-- Resumen del curso --}}
                <div class="flex flex-col mt-4">
                    <div>
                        <x-label for="summary" value="Resumen del Curso" class="mb-2" />
                        <x-textarea for="summary" placeholder="Resumen del Curso" name="summary" class="mb-2 w-full"
                            value="{{ old('summary') }}" id="summary">
                        </x-textarea>
                    </div>
                </div>
                {{-- Descripción del curso --}}
                <div class="flex flex-col mb-4">
                    <div>
                        <x-label for="description" value="Descripción del Curso" class="mb-2" />
                        <x-textarea for="description" placeholder="Descripción del Curso" name="description"
                            class="mb-2 w-full" value="{{ old('description') }}" id="description">
                        </x-textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-label for="category_id" value="Categoría" class="mb-2" />
                        <x-select name="category_id" id="category_id" required>
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Seleccione una
                                categoría</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : ''
                                }}>
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
                            <option value="{{ $level->id }}" {{ old('level_id')==$level->id ? 'selected' : '' }}>
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
                            <option value="{{ $price->id }}" {{ old('price_id')==$price->id ? 'selected' : '' }}>
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
                {{-- Imagen del curso --}}
                <div class="mt-6">
                    <x-label for="file" value="Imagen del Curso"
                        class="mb-2 font-semibold text-gray-800 dark:text-gray-200" />
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center md:space-x-6">
                        {{-- Input file de subida de imagen --}}
                        <div class="flex-1 md:my-0">
                            <x-label for="file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed 
                   border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer 
                   hover:border-blue-400 transition p-4 bg-gray-50 dark:bg-gray-800/50">
                                <div class="flex flex-col items-center">
                                    <span class="text-3xl"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                                        Haz clic para subir o arrastra una imagen
                                    </p>
                                </div>
                                <x-input type="file" name="image" id="file" class="hidden" accept="image/*" />
                            </x-label>
                        </div>
                        {{-- Previsualización de imagen --}}
                        <div class="my-6 flex-1 md:my-0">
                            <p class="text-gray-700 dark:text-gray-300 font-medium mb-2">Previsualización:</p>
                            <div
                                class="w-64 rounded-xl overflow-hidden shadow-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                                <figure>
                                    <img id="previewImage" src="https://via.placeholder.com/300x200"
                                        alt="Previsualización" class="w-full h-auto object-cover" />
                                </figure>
                            </div>
                        </div>
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

    @push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
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

    // Función para previsualizar la imagen
    document.getElementById('file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
    @endpush

</x-instructor-layout>