<section class="content-header">
	<h1>{{ $txt['Site'] }}</h1>
	@include('webbase.breadcrumb')
</section>

<section class="content">

	<div class="row loadingImg">
		<img src="{{ URL::asset('webimage/loading.gif') }}" alt="loadingImg">
	</div>

	<div class="row report">

		<section class="col-lg-6 connectedSortable">
			<div class="box box-success">
				<report-one ref="report1" :data="{{ $report['report1'] }}"></report-one>
				<div id="report1"></div>
			</div>
			<div class="box box-success">
				<report-three ref="report3" :data="{{ $report['report3'] }}"></report-three>
				<div id="report3"></div>
			</div>
        </section>

		<section class="col-lg-6 connectedSortable">
			<div class="box box-success">
				<report-two ref="report2" :data="{{ $report['report2'] }}"></report-two>
				<div id="report2"></div>
			</div>
			<div class="box box-success">
				<report-four ref="report4" :data="{{ $report['report4'] }}"></report-four>
				<div id="report4"></div>
			</div>
        </section>

		<section class="col-lg-6 connectedSortable">
			<div class="box box-success">
				<report-five ref="report5" :data="{{ $report['report5'] }}"></report-five>
				<div id="report5"></div>
			</div>

        </section>

	</div>

</section>