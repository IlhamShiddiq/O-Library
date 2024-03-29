<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/font.css')}}">

    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

    <title>Login</title>
  </head>
  <body>

    @if (session('status'))
        <div class="message message-danger position-fixed shadow">
            <div class="message-header position-relative text-white rounded-top">
                <h6>Message!!</h6>
                <button class="btn position-absolute text-white" id="btn-close-message"><i class="fas fa-times"></i></button>
                <div class="triangle-up position-absolute"></div>
            </div>
            <div class="message-body">
                <p>{{session('status')}}</p>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="message message-success position-fixed shadow">
            <div class="message-header position-relative text-white rounded-top">
                <h6>Message!!</h6>
                <button class="btn position-absolute text-white" id="btn-close-message"><i class="fas fa-times"></i></button>
                <div class="triangle-up position-absolute"></div>
            </div>
            <div class="message-body">
                <p>{{session('success')}}</p>
            </div>
        </div>
    @endif
        
    <div class="page page-login">
        <svg class="top-absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#1B8A69" fill-opacity="1" d="M0,32L30,42.7C60,53,120,75,180,80C240,85,300,75,360,80C420,85,480,107,540,138.7C600,171,660,213,720,197.3C780,181,840,107,900,101.3C960,96,1020,160,1080,181.3C1140,203,1200,181,1260,170.7C1320,160,1380,160,1410,160L1440,160L1440,0L1410,0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z"></path></svg>
        <svg class="bottom-absolute svg-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#1B8A69" fill-opacity="1" d="M0,128L48,122.7C96,117,192,107,288,128C384,149,480,203,576,234.7C672,267,768,277,864,266.7C960,256,1056,224,1152,213.3C1248,203,1344,213,1392,218.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        <div class="container-fluid">
            <div class="container-form-login">
                <div class="row justify-content-end">
                    <div class="col-12 col-md-12 col-lg-8 dp-relative col-vector">
                        <div class="vector-1">
                            <img src="{{asset('img/vectors/vector.png')}}" alt="Vector-1">
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 text-center col-form">
                        <img src="{{asset('img/vectors/admin.png')}}" alt="Admin Icon" width="86">
                        <h1 class="mb-5">WELCOME</h1>
                        <form method="POST" action="{{ url('/logged_in') }}" class="mb-5">
                            @csrf
                
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="inlineFormInputGroup" placeholder="Username" name="username" value="{{ old('username') }}" autofocus>
                                @error('username')
                                    <div class="invalid-feedback text-left">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="input-group mb-5">
                                <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inlineFormInputGroup" placeholder="Password" name="password">
                                @error('password')
                                    <div class="invalid-feedback text-left">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-green-login text-white mb-1">LOGIN</button>
                            <a href="{{url('/account/confirm')}}" class="confirm-acc">Konfirmasi Akun</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-btn position-fixed">
      <a href="{{ url('/') }}" class="btn text-center text-white rounded-circle"><i class="fas fa-home"></i></a>
    </div>

    <!-- Optional JavaScript -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/font-awesome.js')}}"></script>
    <script src="{{asset('js/close-message-btn.js')}}"></script>
  </body>
</html>