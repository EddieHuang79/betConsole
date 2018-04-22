<section class="content-header">
	<h1>{{ $txt["service_list"] }}</h1>
	@include('webbase.breadcrumb')
</section>
<section class="content">
	@include('webbase.search_tool')
    <div class="row basicList">
        <div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">{{ $txt["service_list"] }}</h3>
					<i class="fa fa-search" @click="SearchToolDisplay"></i>
				</div>
				<div class="box-body">
					<basic-list ref="basicList" :list="{{ $htmlJsonData }}" :txt="{{ $JsonTxt }}"></basic-list>
				</div>
			</div>
		</div>
	</div>
	{{ $service->links() }}
</section>