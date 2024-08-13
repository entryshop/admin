<div class="d-flex gap-2">
    @foreach($buttons as $button)
        <div {!! $button->wrapper() !!}>
            {!! $button->render(['row' => $row??null]) !!}
        </div>
    @endforeach
</div>
