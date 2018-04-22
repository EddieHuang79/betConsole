<ol class="breadcrumb">
	<li><a href="/admin_index"><i class="fa fa-dashboard"></i> {{ $txt['web_index'] }}</a></li>
	@if( !empty($breadcrumb) )
		<li>{{ $breadcrumb[0]['name'] }}</li> 
		<li class="active">{{ $breadcrumb[1]['name'] }}</li> 
	@endif
</ol>