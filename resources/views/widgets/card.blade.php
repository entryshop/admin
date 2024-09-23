<div class="card">
    @if(!empty($title) || !empty($right))
        <div class="card-header">
            @if(!empty($right))
                <div class="float-end">
                    {!! render($right) !!}
                </div>
            @endif
            <h3 class="card-title mb-0">{!! render($title) !!}</h3>
        </div>
    @endif
    @if(!empty($content))
        <div class="card-body">
            {!! render($content) !!}
        </div>
    @endif
    @if(!empty($footer))
        <div class="card-footer">
            {!! render($footer) !!}
        </div>
    @endif
</div>
