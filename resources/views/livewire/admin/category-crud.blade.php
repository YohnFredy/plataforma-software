<div>
    <h1 class="font-bold mb-2 text-palette-200">
        {{ $isEditMode ? 'Editar categoría' : 'Crear categoría' }}
    </h1>
    <div class="p-4 rounded-lg bg-white border-palette-200/25 shadow-lg shadow-palette-800">

        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'save' }}">
            <div class="grid grid-cols-6 gap-4 gap-y-2">
                <div class="col-span-6 md:col-span-4">
                    <x-input-l type="text" label="Nombre:" for="name" wire:model.live="name" required autofocus
                        autocomplete="name" />
                </div>

                <div class="col-span-6 md:col-span-2">
                    <x-select-l label="Producto activo:" nameOption="" for="is_active" wire:model="is_active">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </x-select-l>
                </div>

                {{-- Selector dinámico de categorías --}}
                @foreach ($categoryLevels as $level => $categories)
                    @if ($categories->isNotEmpty())
                        <div class="col-span-6 md:col-span-2">
                            <x-select-l label="{{ $level === 0 ? 'Categoría:' : 'Subcategoría nivel ' . $level }}"
                                for="level_{{ $level }}" wire:model.live="selectedLevels.{{ $level }}">
                                <option value="" hidden>Seleccionar</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </x-select-l>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="mr-4 text-xl font-bold text-palette-400 hover:text-palette-400/80"
                    href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <x-button type="submit" wire:loading.attr="disabled">
                    {{ $isEditMode ? 'Actualizar' : 'Guardar' }}
                </x-button>
            </div>
        </form>
    </div>
</div>
