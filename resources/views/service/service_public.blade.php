<section class="content-header">
	<h1>{{ $txt["service_public"] }}</h1>
	@include('webbase.breadcrumb')
</section>
<section class="content">
	@include('webbase.search_tool')
    <div class="row">
        <div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ $txt["service_public"] }}</h3>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>{{ $txt['service_name'] }}</th>
								<th>{{ $txt['action'] }}</th>
							</tr>							
						</thead>
						<tbody>
							@if(!empty($service))
								@foreach($service as $row)
									<tr>
										<th>{{ $row->name }}</th>
										<td>{{ $public_txt[$row->public] }}</td>
										<td>@if($row->public == 2)<input type="button" class="btn btn-primary" value="{{ $txt['public'] }}" onClick="location.href='/service_public_process?service_id={{ $row->id }}';"/>@endif</td>
									</tr>
								@endforeach
							@else
									<tr>
										<th colspan="3">{{ $txt['find_nothing'] }}</th>
									</tr>			
							@endif											
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	{{ $service->links() }}
</section>