{{ Form::label($name, $label) }} {!! !empty($required) ? '<span class="col-red">*</span>' : '' !!}
<div class="form-group"> 
	<div class="input-group spinner" data-trigger="spinner">
		<div class="form-line">
			{{ Form::text($name, $value, array_merge(['class'=>'form-control', 'data-rule'=>'defaults'], $attributes)) }}
		</div>
		<span class="input-group-addon">
			<a href="javascript:;" class="spin-up" data-spin="up"><i class="glyphicon glyphicon-chevron-up"></i></a>
			<a href="javascript:;" class="spin-down" data-spin="down"><i class="glyphicon glyphicon-chevron-down"></i></a>
		</span>
	</div>
</div>				
