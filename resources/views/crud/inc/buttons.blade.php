<div class="d-flex gap-2">
    @foreach($buttons as $button)
        <div {!! $button->wrapper() !!}>
            {!! render($button, ['entity' => $entity??null]) !!}
        </div>
    @endforeach
</div>
