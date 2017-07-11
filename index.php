<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Safefocus Login</title>
  
  
  
      <link rel="stylesheet" href="public/css/style.css">

  
</head>

<body>
  <div class="login-page">
  <div class="form">
    <form class="register-form role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form">
      <input type="text" placeholder="username"/>
      <input type="password" placeholder="password"/>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
  <script src='public/js/jquery-3.2.1.min.js'></script>

    <script src="public/js/index.js"></script>

</body>
</html>