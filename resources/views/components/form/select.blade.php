{{ Form::label($name, $label) }} {!! !empty($required) ? '<span class="col-red">*</span>' : '' !!}
<div class="form-group">
	<div class="form-line">
		{{ Form::select($name, $options, $value, array_merge(['class'=>'form-control show-tick'], $attributes)) }}
	</div>
</div>				
