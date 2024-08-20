<x-admin::fields.field :$name :id="$key" :label="$label??''">
    <x-admin::fields.switch :$name :value="$value??null" :id="$key"/>
</x-admin::fields.field>
