{{ Form::label($name, $label) }} {!! ($required) ? '<span class="col-red">*</span>' : '' !!}
<div class="form-group">
	<div class="form-line">
		{{ Form::password($name, array_merge(['class'=>'form-control','placeholder'=>'Enter '.$label], $attributes)) }}
	</div>
</div>				
