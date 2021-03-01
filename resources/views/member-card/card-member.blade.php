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
            object-fit: cover !important;
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
            object-fit: cover;
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
        .more-wrapper {
            width: 100%;
            margin: 0 0 20px 0;
            padding: 0 20px;
            box-sizing: border-box;
        }
        .more-content {
            width: 100%;
            height: 120px;
            background-color: rgb(196, 245, 198);
            border-radius: 10px;
            padding: 10px 15px;
            box-sizing: border-box;
        }
        .text-center {
            text-align: center;
        }
        .role {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            border-bottom: 1px solid rgb(126, 126, 126);
            padding-bottom: 7px;
        }
        .rules {
            padding-top: 5px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            text-align: justify;
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
                <div>
                    <div class="profile">
                        <div class="foto">
                            <img src="{{public_path('uploaded_files/member-foto/'.$user->profile_photo_path)}}" alt="Foto" style="border-radius: 100%;">
                        </div>
                        <div class="name-wrapper">
                            <div class="name">
                                <h1>{{$user->name}} ({{$user->nomor_induk}})</h1>
                                <h2>Kartu Anggota</h2>
                                <div class="more-wrapper">
                                    <div class="more-content">
                                        <div class="role text-center">
                                            Siswa
                                        </div>
                                        <div class="rules">
                                            <div class="text-center">Peraturan Perpustakaan</div>
                                            - Sekali meminjam maksimal boleh meminjam 2 buku <br>
                                            - Jika terlambat wajib membayar denda yang sudah ditentukan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>