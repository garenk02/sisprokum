@extends($source == "app" ? 'layouts.app' : 'layouts.web')

@section('title', $module['module_name'])

@section('header')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>{{ $module['module_name'] }} <small>{{ trans('site.data_editor') }}</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			{{ Form::model($data, ['id'=>'form', 'route'=>!empty($data['receiver_id']) ? ['outmemo.update', $data['receiver_id']] : ['outmemo.create', null], 'action'=>'OutmemoController@save', 'class'=>'form-horizontal form-label-left', 'files'=>true]) }}
			{{ Form::hidden('memo_id', null, ['id'=>'memo_id']) }}
			{{ Form::hidden('memo_category', 'internal') }}
			{{ Form::hidden('memo_type', 'Memorandum') }}
<!--
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group bg-blue-grey">
						<h6 class="text-center">Pengirim</h6>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-3 col-xs-12">Pengirim <span style="color:red">*</span></label>
						<div class="col-md-10 col-sm-9 col-xs-12">
							{{ Form::text('memo_sender', (!empty($data['memo_sender_name']) ? $data['memo_sender_name'] : "") . (!empty($data['memo_sender_post_name']) ? " | ".$data['memo_sender_post_name'] : "") . (!empty($data['memo_sender_post_code']) ? " | ".$data['memo_sender_post_code'] : "") . (!empty($data['memo_sender_post_unit']) ? " | ".$data['memo_sender_post_unit'] : ""), ['class'=>'form-control sender','required'=>true]) }} {{ Form::hidden('memo_sender_id', !empty($data['memo_sender_id']) ? $data['memo_sender_id'] : 0, ['class'=>'sender_id','required'=>true]) }}
						</div>
					</div>
				</div>
			</div>
-->
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Penerima</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Penerima <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					<fieldset id="receiver">
@if (!empty($data['memo_receiver']))
	@foreach ($data['memo_receiver'] as $row => $receiver)
					<div class="row border-line input-form">
						<div class="col-xs-12">
							<label for="name">Nama</label>		
							{{ Form::hidden('receiver[id][]', !empty($receiver['id']) ? $receiver['id'] : "", ['class'=>'receiver_id']) }}
							{{ Form::text('receiver[name][]', $receiver['name'], ['class'=>'form-control receiver_name receiver']) }}					
							<label for="post_name">Jabatan</label>	
							{{ Form::hidden('receiver[post_id][]', !empty($receiver['post_id']) ? $receiver['post_id'] : "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('receiver[post_type][]', !empty($receiver['post_type']) ? $receiver['post_type'] : "", ['class'=>'receiver_post_type']) }}								
							{{ Form::text('receiver[post][]', $receiver['post'], ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('receiver[unit][]', $receiver['unit'], ['class'=>'form-control receiver_unit']) }}
						</div>	
					</div>
	@endforeach
@else					
					<div class="row border-line input-form">
						<div class="col-xs-12">
							<label for="name">Nama</label>		
							{{ Form::hidden('receiver[id][]', "", ['class'=>'receiver_id']) }}							
							{{ Form::text('receiver[name][]', "", ['class'=>'form-control receiver_name receiver']) }}					
							<label for="post_name">Jabatan</label>		
							{{ Form::hidden('receiver[post_id][]', "", ['class'=>'receiver_post_id']) }}
							{{ Form::hidden('receiver[post_type][]', "", ['class'=>'receiver_post_type']) }}								
							{{ Form::text('receiver[post][]', "", ['class'=>'form-control receiver_post']) }}
							<label for="post_unit">Nama Unit</label>		
							{{ Form::text('receiver[unit][]', "", ['class'=>'form-control receiver_unit']) }}
						</div>	
					</div>
@endif
					</fieldset>
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Hal</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Hal <span style="color:red">*</span></label>
				<div class="col-md-10 col-sm-9 col-xs-12">
					{{ Form::text('memo_title', null, ['class'=>'form-control','required'=>true]) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
				{{ Form::textarea('memo_content', null, ['id'=>'ckeditor']) }}
<!--				{{ Form::bsEditor('memo_content', !empty($data['memo_content']) ? $data['memo_content'] : null) }} -->
				</div>
			</div>
			<div class="form-group bg-blue-grey">
				<h6 class="text-center">Lampiran Relasi</h6>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">&nbsp;</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				<small>
				<ul class="well">
				<li>Kosongkan/abaikan jika tidak ada lampiran.</li>
				<li>Ukuran file yang diizinkan maksimal: 25MB.</li>
				<li>Tipe file yang di izinkan: jpg, png, pdf.</li>
				</ul>
				</small>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">&nbsp;</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
@if (!empty($data['memo_relation']))
					<ul class="list-unstyled">
@foreach ($data['memo_relation'] as $relation)
					<li><p>- {{ $relation['relation_agenda'] }}
					<span class="pull-right">
					<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-xs btn-success peek-{{ $relation['relation_type'] }}" rel="{{ $relation['relation_agenda'] }}" title="Lihat Relasi"><i class="fa fa-eye"></i></button>
@if (in_array($relation['relation_user'], $profile['user_posts']))
					<button type="button" class="btn btn-xs btn-danger remove" rel="{{ $relation['relation_id'] }}" title="Hapus Relasi" onclick="return confirm('{{ trans('site.confirm_delete') }}')"><i class="fa fa-trash"></i></button>
@endif
					</span></p>
					</li>
@endforeach
					</ul>
@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Surat Masuk</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::text('inbox_relation_text', "", ['id'=>'inbox_relation','class'=>'form-control', 'placeholder'=>'ketik Nomor Agenda Surat Masuk']) }}
				{{ Form::hidden('inbox_relation[]', "", ['id'=>'inbox_relation_id']) }} 	
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Nomor Surat Keluar</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
				{{ Form::text('outbox_relation_text', "", ['id'=>'outbox_relation','class'=>'form-control', 'placeholder'=>'ketik Nomor Agenda Surat Keluar']) }}
				{{ Form::hidden('outbox_relation[]', "", ['id'=>'outbox_relation_id']) }} 	
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2 col-sm-3 col-xs-12">Copy Digital</label>
				<div class="col-md-10 col-sm-9 col-xs-12">
@if (!empty($data['memo_meta_files']))
@foreach ($data['memo_meta_files'] as $file)
				<div class="input-group input-form">
				{{ Form::text('memo_meta_files[]', $file, ['class'=>'form-control receiver', 'onclick'=>'blur()', 'onfocus'=>'blur()']) }}
				<span class="input-group-btn">
				<button type="button" data-toggle="modal" data-target="#popup" class="btn btn-info view" rel="{{ $file }}"><i class="fa fa-eye"></i></button>
				<button type="button" class="btn btn-success download" rel="{{ $file }}"><i class="fa fa-download"></i></button>
				<button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>				
				</span>
				</div>
@endforeach
@endif
				{{ Form::file('file_1', ['class' => 'form-control']) }}
				{{ Form::file('file_2', ['class' => 'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3 col-md-offset-2 col-sm-6 col-sm-offset-3 col-xs-12">
					<em><span style="color:red">*</span> <small>{{ trans('site.required') }}</small></em>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="text-right">
					<button type="button" id="save" class="btn btn-success m-t-15 waves-effect"><i class="fa fa-save"></i> {{ trans('site.save') }}</button>
					<button type="button" id="back" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-undo"></i> {{ trans('site.cancel') }}</button>
				</div>
			</div>
			{{ Form::close() }}
		  </div>
		</div>
	</div>
</div>

<div id="popup" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="title" class="modal-title">Popup</h4>
      </div>
      <div id="data" class="modal-body">
        <p>{{ trans('site.error_nodata') }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<!-- Ckeditor -->
<script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>

<script language="javascript">
$(document).ready(function()
{
	$('#add_receiver').click(function() {
		var $template = $('#receiver_tmp').html();
		$('#receiver').append($template);

		$('.remove').click(function() {
			remove(this);
		});

		$('.receiver').autocomplete({
			serviceUrl: "{{ url('user/list/name') }}",
			onSelect: function (suggestion) {
				var input = $(this).closest('div');
				
				input.find('.receiver_id').val(suggestion.data);
				input.find('.receiver_post_id').val(suggestion.post_id);
				input.find('.receiver_post_type').val(suggestion.post_type);			
				input.find('.receiver_post').val(suggestion.post_name);
				input.find('.receiver_unit').val(suggestion.post_unit);	
			}
		});
	});

	$('#add_cc').click(function() {
		var $template = $('#cc_tmp').html();
		$('#cc').append($template);

		$('.remove').click(function() {
			remove(this);
		});

		$('.receiver').autocomplete({
			serviceUrl: "{{ url('user/list/name') }}",
			onSelect: function (suggestion) {
				var input = $(this).closest('div');
				
				input.find('.receiver_id').val(suggestion.data);
				input.find('.receiver_post_id').val(suggestion.post_id);
				input.find('.receiver_post_type').val(suggestion.post_type);			
				input.find('.receiver_post').val(suggestion.post_name);
				input.find('.receiver_unit').val(suggestion.post_unit);	
			}
		});
	});
	
	$('#inbox_relation').autocomplete({		
		serviceUrl: "{{ url('inbox/list/memo') }}",
		minChars: 3,
		maxHeight: 100,
		onSelect: function (suggestion) {
			$('#inbox_relation_id').val(suggestion.data);
		},		
	});

	$('#outbox_relation').autocomplete({		
		serviceUrl: "{{ url('outbox/list/memo') }}",
		minChars: 3,
		maxHeight: 100,
		onSelect: function (suggestion) {
			$('#outbox_relation_id').val(suggestion.data);
		},		
	});	

	$('.view').click(function(){
		$('#title').html('Berkas Copy Digital');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('outmemo/fileview') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});

	$('.peek-inbox').click(function(){
		$('#title').html('Relasi Surat');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['relation_id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('inbox/relationfile') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});

	$('.peek-outbox').click(function(){
		$('#title').html('Relasi Surat');

		data = new Object;
		data['_token'] = "{{ csrf_token() }}";
		data['relation_id'] = $(this).attr('rel');

		$.ajax({
			type: "POST",
			url: "{{ url('outbox/relationfile') }}",
			dataType: "text",
			data: data,
			success : function(data){
				if (data != ""){ $('#data').html(data); }
				else { $('#data').html("<p>{{ trans('site.error_nodata') }}</p>"); }
			}
		});
	});

	$('.download').click(function(){
		var	url = "{{ url('outmemo/filedownload') }}/" + $(this).attr('rel');
		window.open(url);
	});

	$('.remove').click(function() {
		remove(this);
	});

	function remove(id) {
		$(id).closest('div.input-form').remove();
	}

	$('.sender').autocomplete({
		serviceUrl: "{{ url('user/list/name') }}",
		onSelect: function (suggestion) {
			$('#sender_id').val(suggestion.data);
			$('#sender_post_id').val(suggestion.post_id);
			$('#sender_post_type').val(suggestion.post_type);
			$('#agenda_unit').val(suggestion.post_code).change();
		}
	});

	$('.receiver').autocomplete({
		serviceUrl: "{{ url('user/list/name') }}",
		onSelect: function (suggestion) {
			var input = $(this).closest('div');
			
			input.find('.receiver_id').val(suggestion.data);
			input.find('.receiver_post_id').val(suggestion.post_id);
			input.find('.receiver_post_type').val(suggestion.post_type);			
			input.find('.receiver_post').val(suggestion.post_name);
			input.find('.receiver_unit').val(suggestion.post_unit);	
		}
	});

	$('#memo_content').wysiwyg({});
	autosize($('#memo_content'));

	$('#save').click(function()
	{
		var hasError = false;
		$('#memo_content_area').val($('#memo_content').html());

		$('[required]').each(function() {
			if (this.value.trim() == ""){
				hasError = true;
				$(this).attr('placeholder', "{{ trans('site.error_required') }}");
				$(this).focus();
				swal("Error!", "{{ trans('site.error_required') }}", "error");
			}
		});

		if ($('#memo_content_area').val() == "") {
			hasError = true;
			$('#memo_content').focus();
			swal("Error!", "{{ trans('site.error_required') }}", "error");
		}

		if (hasError == false){
			$('#form').submit();
		}

		return false;
	});

    CKEDITOR.replace('ckeditor', {
		toolbarGroups: [
			{ name: 'document', groups: [ 'document', 'doctools' ] },
			{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
			{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
			{ name: 'forms', groups: [ 'forms' ] },
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
			{ name: 'colors', groups: [ 'colors' ] },
			{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
			{ name: 'links', groups: [ 'links' ] },
			{ name: 'insert', groups: [ 'insert' ] },
			'/',
			{ name: 'styles', groups: [ 'styles' ] },
			{ name: 'tools', groups: [ 'tools' ] },
			{ name: 'others', groups: [ 'others' ] },
			{ name: 'about', groups: [ 'about' ] }
		],
		removeButtons: 'Save,NewPage,Preview,Print,Templates,Scayt,SelectAll,Find,Replace,BGColor,Blockquote,HorizontalRule,ShowBlocks,BidiRtl,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,Anchor,Link,Unlink,Flash,Smiley,Iframe,Image,About,CreateDiv,Language,CopyFormatting'
	});
    CKEDITOR.config.height = 300;
});
</script>
@endsection
