<div class="row">
@if (preg_match('/jpg/i', $file) || preg_match('/gif/i', $file) || preg_match('/png/i', $file))
	<img src="{{ $file }}" width="70%">
@else
	<iframe src="{{ $file }}" style="width:70%; height: 600px" frameborder="0"></iframe>
@endif
</div>

