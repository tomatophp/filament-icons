<div>
    @php $checkIconExists = \TomatoPHP\FilamentIcons\Models\Icon::where('name', $getState())->first() @endphp
    @if($checkIconExists)
        <x-icon :name="$getState()" class="h-6 w-6"  />
    @endif
</div>
