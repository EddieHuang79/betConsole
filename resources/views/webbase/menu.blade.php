@section('menu')
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
			<img src="{{ URL::asset($data->photo) }}" class="img-circle" alt="User Image" style="width: 45px; height: 45px;">
		</div>
		<div class="pull-left info">
			<p>{{ $user['real_name'] }}</p>
			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	</div>

	<!-- search form -->
	<form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search...">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</form>
	<!-- /.search form -->

	<!-- Sidebar Menu -->
	<ul class="sidebar-menu">
		<li class="header">主功能表</li>

		@foreach($service_list as $row)
		<li class="treeview">
			@if(!empty($row['child']))
			<a href="#"><i class="fa @if(isset($icon[$row['name']])){{ $icon[$row['name']] }}@endif"></i> <span>{{ $row['name'] }}</span> <i class="fa fa-angle-left pull-right"></i></a>
			<ul class="treeview-menu">
				@foreach($row['child'] as $child)
				<li><a href="{{ $child['link'] }}?service_id={{ $child['id'] }}" page="page{{ $child['id'] }}">{{ $child['name'] }}</a></li>
				@endforeach
			</ul>
			@else
			<a href="{{ $row['link'] }}?service_id={{ $row['id'] }}" page="page{{ $row['id'] }}"><i class="fa @if(isset($icon[$row['name']])){{ $icon[$row['name']] }}@endif"></i> <span>{{ $row['name'] }}</span> <i class="fa fa-angle-left pull-right"></i></a>
			@endif
		</li>				
		@endforeach

		<li class="treeview">
			<a href="/logout"><i class="fa fa-lock"></i> <span>登出</span> <i class="fa fa-angle-left pull-right"></i></a>
		</li>
	</ul>
	<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
<input type="hidden" class="service_id" value="{{ $service_id }}">
@show