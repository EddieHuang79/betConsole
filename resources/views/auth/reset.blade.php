<div class="login-box">
	<div class="login-logo">
		<a href="#">{{ $txt["Site"] }}</a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">{{ $txt['reset'] }}</p>
		<table class="table table-bordered table-striped">
			<tbody>
				<tr>
					<th>{{ $txt["reset_description"] }}</th>
				</tr>										
			</tbody>
		</table>	
		<button class="btn btn-lg btn-primary btn-block" onclick="location.href='/login';">{{ $txt['login'] }}</button>
	</div>
</div>