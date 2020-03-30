<div class="input-prepend input-group">
	{{ Form::text($name, !empty($value) ? date('m/d/Y', strtotime($value)) : "", array_merge(['class'=>'form-control datepicker','placeholder'=>'mm/dd/yyyy'], $attributes)) }}
	<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
</div>
