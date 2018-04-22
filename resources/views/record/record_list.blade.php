<section class="content-header">
	<h1>{{ $txt["record_list"] }}</h1>
	@include('webbase.breadcrumb')
</section>
<section class="content">
	
	@include('webbase.search_tool')

	@foreach($show_error as $row)
	<h5>{{ $row }}</h5>
	@endforeach

	@if(empty($show_error))
	No Data
	@endif
</section>