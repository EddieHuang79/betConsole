<div id="Verify">
	<div class="form-group has-feedback">
		<input type="text" id="VerifyCode" class="form-control" placeholder="{{ $txt['verify_input'] }}" name="verify"  maxlength="4" required/>
	</div>
	<div class="verify_code">
		@if(is_string( $Verifycode_img) )
		<img src="{{ URL::asset($Verifycode_img) }}" alt="" height="36" class="verify_code">
		@endif
	</div>
</div>
<br />