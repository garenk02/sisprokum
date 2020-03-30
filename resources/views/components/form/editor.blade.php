<div id="alerts"></div>
<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#{{ $name }}">
	<div class="btn-group">
		<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i>&nbsp;<b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li>
			<li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li>
			<li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li>
			<li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li>
			<li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li>
			<li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li>
			<li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li>
			<li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li>
			<li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li>
			<li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li>
			<li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li>
			<li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li>
			<li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li>
			<li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li>
			<li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li>
		</ul>		
	</div>
	<div class="btn-group">
		<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a data-edit="fontSize 5"><p style="font-size:17px">Huge</p></a></li>
			<li><a data-edit="fontSize 3"><p style="font-size:14px">Normal</p></a></li>
			<li><a data-edit="fontSize 1"><p style="font-size:11px">Small</p></a></li>
		</ul>
	</div>
	<div class="btn-group">
		<a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
		<a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
		<a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
		<a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
	</div>
	<div class="btn-group">
		<a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
		<a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
		<a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
		<a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
	</div>
	<div class="btn-group">
		<a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
		<a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
		<a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
		<a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
	</div>
	<div class="btn-group">
		<a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
		<a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
	</div>
</div>				

<div id="{{ $name }}" class="editor-wrapper" tabindex='1'>{!! $value !!}</div>
			
{{ Form::textarea($name, $value, array_merge(['id'=>$name.'_area','class'=>'form-control editor-wrapper','style'=>'display:none'], $attributes)) }}
