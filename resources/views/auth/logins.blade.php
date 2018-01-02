<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Klinik Sehati</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/css/animate.min.css" rel="stylesheet">
    <!-- Klinik.css -->
    <link href="/css/klinik.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <h1 class="centering"><i class="fa fa-asterisk"></i> KLINIK SEHATI </h1>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <h3>LOGIN PAGE</h3>
            {!! Form::open(['url'=>'logins', 'class'=>'form-horizontal']) !!}
            <div class="form-group{{$errors->has('email') ? 'has error' : ''}}">
              {!! Form::label('email', 'Email', ['class'=>'col-md-1 control-label']) !!}
              <div class="col-md-9 col-md-offset-2">
                {!! Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Type Your Email']) !!}
                {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? 'has-error' : '' }}">
              {!! Form::label('password', 'Password', ['class'=>'col-md-1 control-label']) !!}
              <div class="col-md-9 col-md-offset-2">
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Type your password']) !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <div class="checkbox">
                  <label>
                    {!! Form::checkbox('remember') !!} ingat saya
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-sign-in"></i> Login
                </button>
                <a class="btn btn-link centering" href="{{ url('/password/reset') }}">Lupa Password</a>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="separator">
              <div class="clearfix"></div>
              <p class="change_link">Belum memiliki akun?
                <a href="#signup" class="to_register">Hubungi administrator</a>
              </p>
            </div>
            {!! Form::close() !!}
            <!--
            <form>
              <h1>Login</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default" href="index.html">Log in</a>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-asterisk"></i> Klinik Sehati</h1>
                  <p>©2016 All Rights Reserved. Klinik Sehati</p>
                </div>
              </div>
            </form>
            -->
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <h3>REGISTER PAGE</h3>
            {!! Form::open(['url'=>'/logins', 'class'=>'form-horizontal']) !!}
              <div class="form-group{{ $errors->has('name') ? 'has error' : '' }}">
                {!! Form::label('name', 'Nama', ['class'=>'col-md-1 control-label']) !!}
                <div class="col-md-9 col-md-offset-2">
                  {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Type your name']) !!}
                  {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

              <div class="form-group{{$errors->has('email') ? 'has error' : ''}}">
                {!! Form::label('email', 'Email', ['class'=>'col-md-1 control-label']) !!}
                <div class="col-md-9 col-md-offset-2">
                  {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Type your email']) !!}
                  {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

            <div class="form-group{{$errors->has('password') ? 'has error' : ''}}">
              {!! Form::label('password', 'Password', ['class'=>'col-md-1 control-label']) !!}
              <div class="col-md-9 col-md-offset-2">
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Type your password']) !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              {!! Form::label('password_confirmation', 'Konfirmasi Password', ['class'=>'col-md-1 control-label', 'style'=>'margin-top:-8px;']) !!}
              <div class="col-md-9 col-md-offset-2">
                {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Re-type your password']) !!}
                {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-user"></i> Daftar
                </button>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <div class="clearfix"></div>
              <p class="change_link">Have an account ?
                <a href="#signin" class="to_register">Sign in</a>
              </p>
            </div>
          {!! Form::close() !!}




            <!--
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-asterisk"></i> Klinik Sehati</h1>
                  <p>©2016 All Rights Reserved. Klinik Sehati</p>
                </div>
              </div>
            </form>
            -->
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
