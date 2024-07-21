@php
    $iconExists = false;
    if($getState()){
        try {
            app(\BladeUI\Icons\Factory::class)->svg($getState());
             $iconExists = true;
        }catch (\Exception $e){}
    }
@endphp
@if($iconExists)
<div>
    @php $checkIconExists = \TomatoPHP\FilamentIcons\Models\Icon::where('name', $getState())->first() @endphp
    @if($checkIconExists)
        <x-icon :name="$getState()" class="h-6 w-6"  />
    @endif
</div>
@endif
