@extends('../templates/mail')

@section('more-css')
    <style>
        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
            padding-left: 50px;
            padding-right: 50px;
        }
        .link-verification {
            color: rgb(77, 77, 77);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
@endsection

@section('more-content')
    <div class="icon-wa" style="margin-top: 20px; margin-bottom: 20px;">
        <button type="button" class="btn btn-secondary" disabled><i class="fab fa-whatsapp" style="color: white;"></i> {{$verification_code}}</button><br>
        <p class="link-verification">Atau anda dapat membuka link berikut<br> <a href="http://olibrary-smkn-1.herokuapp.com/account/confirm" target="_blank" rel="noopener">http://olibrary-smkn-1.herokuapp.com/account/confirm</a></p>
        <small>Pastikan hanya anda yang tahu kode ini. Jangan biarkan orang lain tahu kode rahasia ini.</small>
    </div>
@endsection