<div style="display: flex; justify-content: start; align-items: center; gap: 8px;">
    <!-- Support Dark Model -->
    <div style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;" >
       {!! $getSVGContent  !!}
    </div>
    <div style="display: flex; flex-direction: column; gap: 1px;">
        <h1>{{ str($icon->getFileName())
            ->replace('.svg', '')
            ->replaceStart('c-','')
            ->replaceStart('o-','')
            ->replaceStart('s-','')
            ->replace('-',' ')
            ->title() }}
        <p style="font-size: 12px;">{{ $provider }}-{{ str($icon->getFileName())->replace('.svg', '') }}</p>
    </div>
</div>
