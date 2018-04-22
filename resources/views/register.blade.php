<div class="register-box">
    <div class="register-logo">
        <a href="#">{{ $txt["Site"] }}</a>
    </div>
    <div class="register-box-body">
        <p class="login-box-msg">{{ $txt['register_title'] }}</p>
        <form method="POST" action="/register">
            @if(!empty($ErrorMsg))
            	@foreach($ErrorMsg as $error)
                    <div class="error">{{ $error }}</div>
                @endforeach
            @endif
            <div class="form-group has-feedback">
                <input type="email" id="inputStoreEmail" name="StoreEmail" class="form-control" placeholder="{{ $txt['account_input'] }}" @if(!empty($Social_login)) value="{{ $Social_login['account'] }}" style="display: none;" @endif  @if(!empty($OriData)) value="{{ $OriData['account'] }}" @endif required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>            
            <div class="form-group has-feedback">
                <input type="password" id="inputStorePassword" name="StorePassword" class="form-control" placeholder="{{ $txt['password_input'] }}" @if(!empty($Social_login)) value="{{ $Social_login['pwd'] }}" style="display: none;" @endif required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>              
            <div class="form-group has-feedback">
                <input type="password" id="inputReCheckPassword" name="ReCheckPassword" class="form-control" placeholder="{{ $txt['password_check_input'] }}" @if(!empty($Social_login)) value="{{ $Social_login['pwd'] }}" style="display: none;" @endif required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>              
            <div class="form-group has-feedback">
                <input type="text" id="inputMobile" name="Mobile" class="form-control" placeholder="{{ $txt['phone_input'] }}" @if(!empty($OriData)) value="{{ $OriData['mobile'] }}" @endif required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>              
            <div class="form-group has-feedback">
                <input type="text" id="inputRealName" name="RealName" class="form-control" placeholder="{{ $txt['real_name_input'] }}" @if(!empty($OriData)) value="{{ $OriData['real_name'] }}" @endif required>
            </div>   
            @include('tool.store_type')           
            <div class="form-group has-feedback">
                <input type="text" id="inputStoreName" name="StoreName" class="form-control" placeholder="{{ $txt['store_name_input'] }}" @if(!empty($OriData)) value="{{ $OriData['StoreName'] }}" @endif maxlength="6" required>
            </div>              
            <div class="form-group has-feedback">
                <input type="text" id="inputStoreCode" name="StoreCode" class="form-control" placeholder="{{ $txt['store_code_input'] }}" @if(!empty($OriData)) value="{{ $OriData['StoreCode'] }}" @endif maxlength="3">
            </div> 
            <div class="form-group has-feedback">
                <input type="text" id="inputInviteCode" name="invite_code" class="form-control" placeholder="{{ $txt['invite_code_input'] }}" @if(!empty($OriData)) value="{{ $OriData['invite_code'] }}" @endif @if(isset($_GET["g"])) value="{{ $_GET['g'] }}" @endif >
            </div>              
        	@include('webbase.verify_code')
            <div class="row">
                <div class="col-xs-4">    
                    <button class="btn btn-primary btn-block btnAction refresh_verify_code" type="button">{{ $txt['refresh_verify_code'] }}</button> 
                </div>
                <div class="col-xs-4">    
                    <button class="btn btn-primary btn-block btnAction" type="button" onclick="location.href='/login';">{{ $txt['back'] }}</button>                       
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-primary btn-block btnAction" type="submit">{{ $txt['register'] }}</button>
                </div>
            </div>         
            @if(!empty($Social_login))
                <input type="hidden" name="social_register" value="1">
            @endif
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
</div>