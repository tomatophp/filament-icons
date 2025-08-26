<div style="display: flex; justify-content: start; align-items: center; gap: 8px;">
    <div style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
        {!! Str::of($item['template'])->replace('{ ICON }', $getIcon . ' ' . $item['pickerClass'])->toString() !!}
    </div>
    <div style="display: flex; flex-direction: column; gap: 1px;">
        <h1>{{ $name }}</h1>
        <p style="font-size: 12px;">{{ $getIcon }}</p>
    </div>
</div>
