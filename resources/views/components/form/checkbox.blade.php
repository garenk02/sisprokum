{{ Form::label($name, $label) }} {!! ($required) ? '<span class="col-red">*</span>' : '' !!}
<div class="form-group">
	{{ Form::checkbox($name, $value, ($checked) ? true : false, ['class'=>'filled-in chk-col-green']) }} 
	{{ Form::label($name, $option) }}
</div>				
