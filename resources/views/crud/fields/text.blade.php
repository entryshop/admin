<x-admin::fields.field :$name :id="$key" :label="$label??''">
    <x-admin::fields.input :$name
           :step="$step??1"
           :prefix="$prefix??null" :suffix="$suffix??null" :placeholder="$placeholder??null"
           :value="old($name,$value??null)" :id="$key" :type="$native_type??'text'"
           class="form-control"/>
</x-admin::fields.field>
