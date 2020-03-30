{{ Form::label($name, $label) }} {!! ($required) ? '<span class="col-red">*</span>' : '' !!}
<div class="form-group">
	<div class="switch">
		<label>{{ !empty($options) && !empty($options[0]) ? $options[0] : '' }} {{ Form::checkbox($name, $value, ($checked) ? true : false) }} <span class="lever switch-col-green"></span> {{ !empty($options) && !empty($options[1]) ? $options[1] : '' }}</label>
	</div>
</div>				
