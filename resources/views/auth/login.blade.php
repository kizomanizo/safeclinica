<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Safefocus Login</title>
  
  
  
      <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
      <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> -->

  
</head>

<body>
  <div class="login-page">
  <div class="form">
    <form class="login-form" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
      <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
          <div class="col-lg-8 col-md-8 col-xs-12 col-sm-6">
              <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="username" required autofocus>

              @if ($errors->has('username'))
                  <span class="help-block">
                      <strong>{{ $errors->first('username') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <!-- <label for="password" class="col-md-4 control-label">Password</label> -->

          <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
          <label for="remember" class="control-label form-control" style="font-size:13px;" >
            <input type="checkbox" class="form-control" style="width: auto;"name="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp;Remember Me
          </label>
      </div>

      <div class="form-group">
          <div class="col-md-8 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                  Login
              </button>
          </div>
      </div>

        <p class="message">
          Forgot Your Password?<a class="btn btn-link" href="{{ route('password.request') }}">Reset</a><br>
          Not registered? <a href="{{ url('/register') }}">Create an account</a>
        </p>
    </form>
  </div>
</div>
  <script src='public/js/jquery-3.2.1.min.js'></script>

    <script src="public/js/index.js"></script>

</body>
</html>