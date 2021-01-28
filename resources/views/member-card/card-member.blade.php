<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            margin: 0;
        }
        .member-card-wrapper {
            width: 590px;
            margin: auto;
            background-color: #fff;
        }
        .member-card-wrapper .member-card {
            background-color: #fff;
            position: relative;
            margin: auto;
            width: 285px;
            height: 430px;
            border-radius: 30px;
            border: 1px solid rgb(122, 122, 122);
            margin-top: 30px;
        }
        .member-card-wrapper .member-card .header {
            width: 100%;
            height: 140px;
        }
        .member-card-wrapper .member-card .header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
        }
        .member-card-wrapper .member-card .profile {
            width: 100%;
            min-height: 10px;
        }
        .member-card-wrapper .member-card .profile .foto {
            margin: auto;
            width: 100px;
            position: relative;
        }
        .member-card-wrapper .member-card .profile .foto img {
            position: absolute;
            top: -60px;
            left: 0;
            width: 100%;
            height: 100px;
            border-radius: 500px;
            box-shadow: 0 0 10px rgb(117, 117, 117);
            object-fit: cover
        }
        .member-card-wrapper .member-card .profile .name h1 {
            margin-top: 50px;
            font-size: 16px;
            text-transform: uppercase;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .member-card-wrapper .member-card .profile .name h2 {
            font-size: 11px;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: rgb(165, 161, 161);
            margin-top: -5px;
        }
        .member-card-wrapper .member-card .profile .rules-wrapper {
            width: 100%;
            position: relative;
            margin-top: -40px;
        }
        .member-card-wrapper .member-card .profile .rules {
            width: 85%;
            height: 250px;
            background-color: rgb(191, 255, 194);
            border-radius: 8px;
            margin: auto;
        }
        .member-card-wrapper .member-card .name-wrapper {
            position: relative;;
            width: 100%;
        }
        .member-card-wrapper .member-card .name-wrapper .name {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            text-align: center;
        }
        .member-card-wrapper .member-card .footer {
            position: absolute;
            bottom: 50px;
            left: 0;
            width: 100%;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 12px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            background-color: #04503c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="cetak-kartu" style="background-color: white;">
        <div class="member-card-wrapper py-2">
            <div class="member-card shadow border depan">
                <div class="header">
                    <img src="{{public_path('img/bg-card.jpg')}}" alt="Perpustakaan">
                </div>
                <div class="profile">
                    <div class="foto">
                        <img src="{{public_path('uploaded_files/member-foto/'.$user->profile_photo_path)}}" alt="Foto" style="border-radius: 100%;">
                    </div>
                    <div class="name-wrapper">
                        <div class="name">
                            <h1>{{$user->name}}</h1>
                            <h2>Kartu Anggota</h2>
                        </div>
                    </div>
                </div>
                {{-- <div class="footer">
                    Perpustakaan SMKN 1 Cimahi
                </div> --}}
            </div>
            {{-- <div class="member-card shadow border belakang">
                <div class="header">
                    <img src="{{public_path('img/bg-card.jpg')}}" alt="">
                </div>
                <div class="profile">
                    <div class="rules-wrapper">
                        <div class="rules"></div>
                    </div>
                </div>
                <div class="footer">
                    Perpustakaan SMKN 1 Cimahi
                </div>
            </div> --}}
        </div>
    </div>
</body>
</html>