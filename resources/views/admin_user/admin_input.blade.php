<section class="content-header">
    @if(!empty($ErrorMsg))
    	@foreach($ErrorMsg as $error)
            <div class="error">{{ $error }}</div>
        @endforeach
    @endif
	<h1>{{ $txt["admin_user_input"] }}</h1>
	@include('webbase.breadcrumb')
</section>
<section class="content basicForm">

	@if( !isset($account_status["left"]) || $account_status["left"] > 0 )

		<div class="row">
	        <div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">{{ $txt["admin_user_input"] }}</h3>
					</div>
					<basic-form ref="basicForm" :list="{{ $htmlJsonData }}" token="{{ csrf_token() }}" :txt="{{ $JsonTxt }}"></basic-form>
		      	</div>
	        </div>
	  	</div>


	@else

	<div class="lightbox">
		<div class="subject">{{ $txt["create_account_disable"] }} <label class="close_btn"> X </label> </div>
		<hr>
		<div class="content">
			{{ $txt["create_account_disable_desc"] }} 
			<br />
			<br />
			<br />
			<button class="btn btn-lg btn-primary btn-block" type="button" onclick="location.href='/buy';">{{ $txt['go_to_store'] }}</button>
		</div>
	</div>

	@endif

</section>
