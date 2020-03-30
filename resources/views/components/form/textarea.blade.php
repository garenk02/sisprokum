{{ Form::label($name, $label) }} {!! ($required) ? '<span class="col-red">*</span>' : '' !!}
<div class="form-group">
	<div class="form-line">
		{{ Form::textarea($name, $value, array_merge(['class'=>'form-control no-resize auto-growth','rows'=>1,'placeholder'=>'Enter '.$label], $attributes)) }}
	</div>
</div>				
