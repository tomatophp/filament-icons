@if(!empty($icon) && str($icon)->contains('heroicon'))
    <x-icon :name="$icon" :class="$size"/>
@elseif(!empty($icon))
    @php
        $getIcon = \TomatoPHP\FilamentIcons\Models\Icon::where('name', $icon)->first();
        $template = $getIcon ?  str($getIcon->template)->replace('{ ICON }', $getIcon->name)->toString() : null;
    @endphp

    @if($getIcon)
        <div class="{{ $style ?: $getIcon->template_class }}">
            {!! $template  !!}
        </div>
    @else
        <div class="{{ $style }}">
            {!! $template  !!}
        </div>
    @endif

@endif
