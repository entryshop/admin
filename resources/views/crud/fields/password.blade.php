<x-admin::fields.field :$name :id="$key" :label="$label??''">
    <x-admin::fields.input :id="$key" type="password" :$name class="form-control"/>
</x-admin::fields.field>
