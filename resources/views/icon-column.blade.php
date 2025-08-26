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
    @php $checkIconExists = \TomatoPHP\FilamentIcons\Facades\FilamentIcons::getIcon($getState()) @endphp
    @if($checkIconExists)
        <x-filament-icon :icon="$getState()" style="display: flex; align-items: center; justify-content: center; text-align: center; width: 25px; height: 25px; text-align: center;" />
    @endif
</div>
@endif
