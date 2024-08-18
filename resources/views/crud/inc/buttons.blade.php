<div class="d-flex gap-2">
    @foreach($buttons as $button)
        <div {!! $button->wrapper() !!}>
            {!! $button->render(['entity' => $entity??null]) !!}
        </div>
    @endforeach
</div>
