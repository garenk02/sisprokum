<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
	  <a href="{{ url('/') }}" class="site_title"><img src="{{ asset('images/logo/logo.png') }}" width="34px"> <span>{{ config('app.initial') }}</span></a>
	</div>
	<div class="clearfix"></div>
	<!-- menu profile quick info -->
<!--	
	<div class="profile">
	  <div class="profile_pic">
		<img src="#" alt="..." class="img-circle profile_img">
	  </div>
	  <div class="profile_info">
		<span>{{ trans('site.welcome') }},</span>
		<h2>#</h2>
	  </div>
	</div>
-->
	<!-- /menu profile quick info -->
	<p>&nbsp;</p>
	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	  <div class="menu_section">
		<ul class="nav side-menu">
		  <li class="{{ empty($module) || $module == 'home' ? 'active' : '' }}"><a href="{{ url('/home') }}"><i class="fa fa-home"></i> {{ trans('site.home') }}</a></li>
@if (!empty($menus))
@foreach ($menus as $menu)
		  <li class="{{ $menu['menu_active'] }}"><a><i class="{{ $menu['menu_icon'] }}"></i> {{ $menu['menu_name'] }} <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu" {{ $menu['menu_active'] == 'active' ? 'style=display:block' : '' }}>
@foreach ($menu['menu_modules'] as $module)
			  <li class="{{ $module['module_active'] }}"><a href="{{ url($module['module_link']) }}">{{ $module['module_name'] }} {!! !empty($module['module_count']) ? '<span class="badge badge-important pull-right">'.$module['module_count'].'</span>' : "" !!}</a></li>
@endforeach
			</ul>
		  </li>
@endforeach
@endif
		</ul>
	  </div>
	</div>
	<!-- /sidebar menu -->
	<!-- /menu footer buttons -->
<!--	
	<div class="sidebar-footer hidden-small">
	  <a href="{{ url('/') }}" data-toggle="tooltip" data-placement="top" title="{{ trans('site.home') }}">
		<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
	  </a>
	  <a href="{{ url('profile') }}" data-toggle="tooltip" data-placement="top" title="{{ trans('site.profile') }}">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	  </a>
	  <a href="{{ url('profile') }}" data-toggle="tooltip" data-placement="top" title="{{ trans('site.profile') }}">
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	  </a>
	  <a href="{{ url('logout') }}" data-toggle="tooltip" data-placement="top" title="{{ trans('site.logout') }}">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	  </a>
	</div>
-->
	<!-- /menu footer buttons -->
  </div>
</div>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
	<nav>
	  <div class="nav toggle">
		<a id="menu_toggle"><i class="fa fa-bars"></i></a>
	  </div>
	  <ul class="nav navbar-nav navbar-right">
		<li class="">
@if (!empty($profile))
		  <a class="dropdown-toggle user-profile" data-toggle="dropdown" aria-expanded="false">
			<img src="{{ asset('images/users/'.$profile['user_photo']) }}" alt="">{{ $profile['user_name'] }} 
			<span class=" fa fa-angle-down"></span>
		  </a>
		  <ul class="dropdown-menu dropdown-usermenu pull-right">
			<li><a href="{{ url('profile') }}"><i class="fa fa-user pull-right"></i> {{ trans('site.profile') }}</a></li>
			<li><a href="{{ url('logout') }}"><i class="fa fa-sign-out pull-right"></i> {{ trans('site.logout') }}</a></li>
		  </ul>
@endif
		</li>
		<li role="presentation" class="dropdown">
		  <a class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
			<i class="fa fa-envelope-o"></i>
@if (!empty($notification))
			<span class="badge bg-green">{{ sizeof($notification) }}</span>
@endif
		  </a>
		  <ul id="notification" class="dropdown-menu list-unstyled msg_list" role="menu">
@if (!empty($notification))
@foreach ($notification as $item)
			<li>
			  <a href="{{ $item['link'] }}">
				<span class="image"><img src="{{ $item['photo'] }}" alt="..."/></span>
				<span>
				  <span>{{ $item['name'] }}</span>
				  <span class="pull-right">{{ $item['date'] }}</span>
				</span>
				<span class="message">
				{{ $item['text'] }}
				</span>
			  </a>
			</li>
@endforeach
@endif
		  </ul>
		</li>
		<li role="presentation" class="dropdown">
		  <a class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
			<i class="fa fa-bullhorn"></i>
@if (!empty($alert))
			<span class="badge bg-green">{{ sizeof($alert) }}</span>
@endif
		  </a>
		  <ul id="alert" class="dropdown-menu list-unstyled msg_list" role="menu">
@if (!empty($alert))
@foreach ($alert as $item)
			<li>
			  <a href="{{ $item['link'] }}">
				<span class="image"><i class="fa fa-bullhorn"></i></span>
				<span>
				  <span>{{ $item['name'] }}</span>
				  <span class="pull-right">{{ $item['date'] }}</span>
				</span>
				<span class="message">
				{{ $item['text'] }}
				</span>
			  </a>
			</li>
@endforeach
@endif
		  </ul>
		</li>		
	  </ul>
	</nav>
  </div>
</div>
<!-- /top navigation -->
