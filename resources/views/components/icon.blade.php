@if(!empty($icon) && str($icon)->contains('heroicon'))
    <x-icon :name="$icon" :style="$style" :class="$class" />
@elseif(!empty($icon))
    @php
        $getIcon = collect(\TomatoPHP\FilamentIcons\Facades\FilamentIcons::getIcon($icon));

        $template = $getIcon ?  str($getIcon['template'])->replace('{ ICON }', $getIcon['name'])->toString() : null;
    @endphp

    @if($getIcon)
        <div class="{{ $class ?: $getIcon['template_class'] }}" style="{{ $style }} display: flex; align-items: center; justify-content: center; font-size: 20px;">
            {!! $template  !!}
        </div>
    @else
        <div class="{{ $class }}" style="{{ $style }} display: flex; align-items: center; justify-content: center;">
            {!! $template  !!}
        </div>
    @endif
@endif
