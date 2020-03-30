<div class="input-prepend input-group">
	{{ Form::text($name, !empty($value) ? date('m/d/Y H:i', strtotime($value)) : "", array_merge(['class'=>'form-control datetimepicker','placeholder'=>'mm/dd/yyyy hh:mi'], $attributes)) }}
	<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
</div>
