<div class="login-box">
    <div class="login-logo">
        <a href="#">{{ $txt["Site"] }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">{{ $txt['forgot_password'] }}</p>
        <form method="POST" action="/forgot_password">
            @if(!empty($ErrorMsg))
                @foreach($ErrorMsg as $error)
                    <div class="error">{{ $error }}</div>
                @endforeach
            @endif
            <div class="form-group has-feedback">
                <input type="email" id="inputEmail" class="form-control" placeholder="{{ $txt['account_input'] }}" name="email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
                    <button class="btn btn-primary btn-block btnAction" type="submit">{{ $txt['send'] }}</button>
                </div>
            </div>  
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
</div>