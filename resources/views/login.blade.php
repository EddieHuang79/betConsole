<div class="login-box">
	<div class="login-logo">
		<a href="#">{{ $txt["Site"] }}</a>
	</div>
	<div class="login-box-body">
		<form method="POST" action="/login">
		    @if(!empty($ErrorMsg))
		    	@foreach($ErrorMsg as $error)
		            <div class="error">{{ $error }}</div>
		        @endforeach
		    @endif
			<div class="form-group has-feedback">
				<input type="email" class="form-control" placeholder="{{ $txt['account_input'] }}" name="email" @if(!empty($OriData)) value="{{ $OriData['account'] }}" @endif required autofocus/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" id="inputPassword" class="form-control" placeholder="{{ $txt['password_input'] }}" name="pwd" required/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			@include('webbase.verify_code')
			<div class="row">
				<div class="col-xs-6">    
					<button class="btn btn-primary btn-block btnAction refresh_verify_code btnColor" type="button">{{ $txt['refresh_verify_code'] }}</button> 
				</div>
				<div class="col-xs-6">
					<button type="submit" class="btn btn-primary btn-block btn-flat btnColor">{{ $txt['login'] }}</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>