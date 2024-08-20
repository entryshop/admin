<x-admin::fields.field :$name :id="$key" :label="$label??''">
    <x-admin::fields.input :$name :value="old($name,$value??null)" :id="$key" type="text" class="form-control"/>
</x-admin::fields.field>
