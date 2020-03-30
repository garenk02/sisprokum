<div class="input-prepend input-group">
	{{ Form::text($name, !empty($value1) && $value1 != "0000-00-00" ? date('m/d/Y', strtotime($value1)) ." - ". date('m/d/Y', strtotime($value2)) : "", array_merge(['class'=>'form-control rangepicker','placeholder'=>'mm/dd/yyyy - mm/dd/yyyy'], $attributes)) }}
	<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
</div>
