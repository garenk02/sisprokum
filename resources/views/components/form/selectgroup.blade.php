<div class="input-prepend input-group">
{{ Form::select($name, $options, $value, array_merge(['class'=>'form-control select2_multiple','multiple'=>'multiple'], $attributes)) }}
</div>