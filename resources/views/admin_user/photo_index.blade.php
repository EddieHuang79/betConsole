<section class="content-header">
	<h1>{{ $txt["photo_upload"] }}</h1>
	@include('webbase.breadcrumb')
</section>
<section class="content">
	<h6>{{ $txt['support_browser'] }}</h6>
	<form action="/photo_upload_process" method="POST" enctype="multipart/form-data">
		<table class="table table-stroped">
			<tbody>
				@if( !empty( $data->photo ) )
				<tr>
					<th> 
						<!-- <img src="{{ $data->photo }}" alt="" class="user_upload">  -->
					</th>
				</tr>
				@endif	
				<tr class="autoUpload">
					<th width="40%">
						<div class="progress text-center">
						    <div id="upload_progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<div ondragover="javascript: dragHandler(event);" ondrop="javascript: dropImage(event);" id="drop_image" class="upload-image image_block">
							{{ $txt["drag_image_at_here_to_upload"] }}
						</div>
					</th>
				</tr>
				<tr class="cropImage">
					<th>
						<div class="crop_txt">{{ $txt["choose_image_to_crop"] }}</div>
						<div class="upload_image_preview"></div>
						<br />
						<input type="button" value="{{ $txt['upload_crop_image'] }}" class="crop">				
					</th>					
				</tr>								
			</tbody>
		</table>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</section>