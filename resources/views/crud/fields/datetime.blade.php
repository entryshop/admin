<x-admin::fields.field :$name :id="$key" :label="$label??''">
    <x-admin::fields.input :$name :value="$value??null" :id="$key" type="datetime-local" class="form-control"/>
</x-admin::fields.field>
