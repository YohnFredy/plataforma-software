@push('css')
    <link href="{{ asset('css/tree.css') }}" rel="stylesheet">
@endpush

<div>
    <h1 class="font-bold mb-2 text-lg text-palette-200 ">Red Binaria</h1>
    <div class="flex justify-center rounded-lg bg-white  shadow-md shadow-palette-300 ">
        <div class="caja">
            <div class="tree ">
                <ul>
                    @include('livewire.office.children-binary', ['node' => $tree])
                </ul>
            </div>
        </div>
    </div>
    <div class="flex justify-center rounded-lg bg-white  shadow-md shadow-palette-300 mt-4 ">
        <p class="mb-4"></p>
        <p class=" text-center mx-6"></p>
    </div>
    <div class="flex justify-center rounded-lg bg-white  shadow-md shadow-palette-300 mt-4">
        <p class="mb-4"></p>
        <p class=" text-center mx-6"></p>
    </div>
</div>
