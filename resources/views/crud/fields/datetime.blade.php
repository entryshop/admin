<x-admin::fields.field :$name :id="$key" :label="$label??''">
    <x-admin::fields.input :$name :step="$step??null" :value="$value??null" :id="$key" type="datetime-local"
                           class="form-control"/>
</x-admin::fields.field>
