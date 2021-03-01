<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}
    <style>
        html, body {
            margin: 0;
            padding: 0
        }
        .header-mail {
            background-color: #3AAF87;
            padding: .5rem;
            box-sizing: border-box;
            margin-bottom: 20px;
        }
        .header-mail .title-mail {
            width: 200px;
            height: 35px;
            position: relative;
        }
        .header-mail .title-mail h1 {
            font-size: 21px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            position: absolute;
            top: 0;
            left: 0;
        }
        .content-mail {
            padding: .5rem;
            width: 100%;
        }
        .icon {
            font-size: 78px;
        }
        .head-title {
            font-size: 24px;
        }
        .sub-title {
            font-size: 14px;
            color: rgb(58, 58, 58);
        }
        .message-mail {
            font-size: 14px;
        }
        .icon-wa a {
                font-size: 14px;
        }
        small {
            color: gray;
        }
        .footer-mail {
            background-color: #3AAF87;
            padding-top: .5rem;
            padding-bottom: 1rem;
            margin-top: 80px;
            width: 100%;
        }
        .d-inline-block {
            display: inline-block
        }
        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            text-decoration: none;
            margin-bottom: 1rem;
        }
        .btn-sm {
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
        }
        .btn-success {
            color: #fff !important;
            background-color: #28a745;
            border-color: #28a745;
        }
        .text-white {
            color: white
        }
    </style>
    @yield('more-css')
</head>
<body>

    <div class="header-mail">
        <div class="container">
            <div class="title-mail d-inline-block position-relative" style="padding-top: 1rem;">
                <h1 class="position-absolute bottom-absolute text-white" style="margin-left: .5rem;">O'LIBRARY</h1>
            </div>
        </div>
    </div>
    <div class="content-mail">
        <div class="container">
            <div class="icon"><i class="fas fa-envelope-open-text"></i></div>
            <h1 class="head-title mb-1">{{$head}}</h1>
            <h2 class="sub-title" style="margin-top: -12px;">{{$sub}}</h2>
            <p class="message-mail ful-width mt-3">{{$pesan}}</p>
            @yield('more-content')
            <br><small style="margin-top: 10px; color: black;">{{$pustakawan}}, Staff Perpustakaan</small>
        </div>
    </div>
    <div class="position-absolute bottom-absolute footer-mail full-width pt-2 pb-3">
        <div class="container">
            <small class="text-white">&copy; 2020 Perpustakaan SMKN 1 Cimahi</small>
        </div>
    </div>

    <script src="{{asset('js/font-awesome.js')}}"></script>
    
</body>
</html>