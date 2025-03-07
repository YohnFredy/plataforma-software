<li>

    @if ($node['level'] < 3)
        <a wire:click="show({{ $node['id'] }} )" class="">
            <div class="grid grid-cols-2 gap-x-3 gap-y-1">
                <div class=" col-span-2 text-palette-300 font-bold">
                    <h4>{{ $node['username'] }}</h4>
                </div>
            
                <div class="col-span-2">
                    <h5 class=" text-palette-200 "> <span
                            class=" text-palette-300 font-medium">Directos:</span>
                        {{ $node['direct_affiliates'] }}</h5>
                </div>

                <div class="col-span-2">
                    <h5 class=" text-palette-200 "><span
                            class="text-palette-400 font-medium">total:</span>
                        {{ $node['total_affiliates'] }}</h5>
                </div>
            </div>
        </a>
    @else
        <a wire:click="show({{ $node['id'] }} )" class="">
            <div class=" text-palette-300">
                <h6>{{ $node['username'] }}</h6>
            </div>
        </a>
    @endif


    @if (!empty($node['children']))
        <ul>
            @foreach ($node['children'] as $child)
                @include('livewire.office.children-unilevel', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
