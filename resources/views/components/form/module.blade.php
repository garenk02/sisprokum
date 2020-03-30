<div class="form-group">
<ul class="list-group">
@foreach ($options as $module_id => $module_name)
<li class="list-group-item">
<div class="row list-modules">
	<div class="col-xs-4">
		{{ Form::checkbox('modules['.$module_id.']', $module_id, !empty($value) && in_array($module_id, array_keys($value)) ? true : false, array_merge(['id'=>'module_'.$module_id, 'class'=>'flat check'], $attributes)) }} 
		{{ Form::label('module_'.$module_id, $module_name) }}
	</div>
	<div class="col-xs-8 list-actions">
@foreach ($actions as $action_id => $action_name)
		<div class="col-xs-{{ ceil(12 / sizeof($actions)) }}">
			{{ Form::checkbox($action_id.'['.$module_id.']', $action_id, !empty($value[$module_id]) && in_array($action_id, $value[$module_id]) ? true : false, array_merge(['id'=>'module_'.$module_id.'_'.$action_id, 'class'=>'flat'], $attributes)) }}
			{{ Form::label('module_'.$module_id.'_'.$action_id, $action_name) }}
		</div>
@endforeach
	</div>
</div>
</li>				
@endforeach
</ul>
</div>
