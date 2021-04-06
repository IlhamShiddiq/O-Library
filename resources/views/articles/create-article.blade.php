@extends('../templates/admin')

@section('more-meta')
    <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Data Artikel')
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/latest/normalize.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/wysiwyg.min.css')}}" />
@section('more-css')
    
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/article-management') }}">Artikel</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/article-management/create') }}">Buat Artikel</a></li>
    </ol>
@endsection

@section('content')
    <div class="create-edit-article">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 p-0 mt-5">
                    <div class="gray-wrapper radius-admin">
                        <div class="info-login-pic text-center border-bottom pb-2">
                            <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Ilham Shiddiq" class="rounded-circle fit-cover" width="70" height="70">
                        </div>
                        <div class="info-login text-center pt-1">
                            <p class="m-1">Halo, {{auth()->user()->username}} ({{auth()->user()->name}})</p>
                            <span class="badge badge-success">{{auth()->user()->role}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <h1 class="title-pagination text-center mb-3">Artikel Baru</h1>
                    <div class="px-2">
                        <form action="{{url('/article-management/create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Artikel</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Masukkan disini....">
                                @error('title')
                                  <div class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Gambar Cover Artikel</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="file" onchange="document.getElementById('article-image').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name">
                                      <label class="custom-file-label" for="photoLibrarian" id="name-label">Browse</label>
                                    </div>
                                </div>
                                @error('file')
                                    <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="img-article-wrapper full-width mb-3">
                                <img src="{{asset('uploaded_files/article-image/article-default.jpg')}}" alt="Cover" class="full-width fit-cover border" id="article-image">
                            </div>
                            <div class="mb-3">
                                <div id="editor1" class="wysiwyg position-relative">
                                    <textarea name="editor" cols="8" placeholder="Artikel ..." class="is-invalid">
                                        <b>Isikan artikel yang ingin anda tulis disini..</b><div><br></div><div>Paragraf ke-1</div><div><br></div><div>Paragraf ke-2</div>
                                    </textarea>
                                </div>
                                @error('editor')
                                    <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sinopsis Artikel</label>
                                <textarea class="form-control @error('synopsis') is-invalid @enderror" rows="4" placeholder="Sinopsis artikel" name="synopsis"></textarea>
                                @error('synopsis')
                                    <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_private">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Buat artikel ini menjadi private
                                </label>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary px-5">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script type="text/javascript" src="{{asset('js/wysiwyg.min.js')}}"></script>
    <script>
        // var element = document.querySelector(".wysiwyg-popup");
        // element.classList.add("position-absolute")
        // element.classList.add("bottom-absolute")

        function ready(fn)
        {
            if( document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading" )
                fn();
            else
                document.addEventListener( 'DOMContentLoaded', fn );
        }
        ready(function() {
            // Buttons
            var htmlparser = document.implementation.createHTMLDocument('');
            // htmlparser.body.innerHTML = '<button>Insert text</button>';
            var customButton = htmlparser.body.firstChild;
            var buttons = [
                // generic
                customButton,
                {
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M15.6 10.79c.97-.67 1.65-1.77 1.65-2.79 0-2.26-1.75-4-4-4H7v14h7.04c2.09 0 3.71-1.7 3.71-3.79 0-1.52-.86-2.82-2.15-3.42zM10 6.5h3c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-3v-3zm3.5 9H10v-3h3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>',
                    action: 'bold',
                    hotkey: 'b',
                    attr: { // attributes
                        title: 'Bold (Ctrl+B)',
                    },
                },
                {
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 4v3h2.21l-3.42 8H6v3h8v-3h-2.21l3.42-8H18V4z"/></svg>',
                    action: 'italic',
                    hotkey: 'i',
                    attr: { // attributes
                        title: 'Italic (Ctrl+I)',
                    },
                },
                {
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17c3.31 0 6-2.69 6-6V3h-2.5v8c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11V3H6v8c0 3.31 2.69 6 6 6zm-7 2v2h14v-2H5z"/></svg>',
                    action: 'underline',
                    hotkey: 'u',
                    attr: { // attributes
                        title: 'Underline (Ctrl+U)',
                    },
                },
                {
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.24 8.75c-.26-.48-.39-1.03-.39-1.67 0-.61.13-1.16.4-1.67.26-.5.63-.93 1.11-1.29.48-.35 1.05-.63 1.7-.83.66-.19 1.39-.29 2.18-.29.81 0 1.54.11 2.21.34.66.22 1.23.54 1.69.94.47.4.83.88 1.08 1.43.25.55.38 1.15.38 1.81h-3.01c0-.31-.05-.59-.15-.85-.09-.27-.24-.49-.44-.68-.2-.19-.45-.33-.75-.44-.3-.1-.66-.16-1.06-.16-.39 0-.74.04-1.03.13-.29.09-.53.21-.72.36-.19.16-.34.34-.44.55-.1.21-.15.43-.15.66 0 .48.25.88.74 1.21.38.25.77.48 1.41.7H7.39c-.05-.08-.11-.17-.15-.25zM21 12v-2H3v2h9.62c.18.07.4.14.55.2.37.17.66.34.87.51.21.17.35.36.43.57.07.2.11.43.11.69 0 .23-.05.45-.14.66-.09.2-.23.38-.42.53-.19.15-.42.26-.71.35-.29.08-.63.13-1.01.13-.43 0-.83-.04-1.18-.13s-.66-.23-.91-.42c-.25-.19-.45-.44-.59-.75-.14-.31-.25-.76-.25-1.21H6.4c0 .55.08 1.13.24 1.58.16.45.37.85.65 1.21.28.35.6.66.98.92.37.26.78.48 1.22.65.44.17.9.3 1.38.39.48.08.96.13 1.44.13.8 0 1.53-.09 2.18-.28s1.21-.45 1.67-.79c.46-.34.82-.77 1.07-1.27s.38-1.07.38-1.71c0-.6-.1-1.14-.31-1.61-.05-.11-.11-.23-.17-.33H21z"/></svg>',
                    action: 'strikethrough',
                    hotkey: 's',
                    attr: { // attributes
                        title: 'Strikethrough (Ctrl+S)',
                    },
                },
                {
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M0 0h24v24H0z" fill="none"/><path fill-opacity=".36" d="M0 20h24v4H0z"/><path d="M11 3L5.5 17h2.25l1.12-3h6.25l1.12 3h2.25L13 3h-2zm-1.38 9L12 5.67 14.38 12H9.62z"/></svg>',
                    action: 'colortext',
                    attr: { // attributes
                        title: 'Text color',
                    },
                },
                {
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M0 0h24v24H0z" fill="none"/><path d="M16.56 8.94L7.62 0 6.21 1.41l2.38 2.38-5.15 5.15c-.59.59-.59 1.54 0 2.12l5.5 5.5c.29.29.68.44 1.06.44s.77-.15 1.06-.44l5.5-5.5c.59-.58.59-1.53 0-2.12zM5.21 10L10 5.21 14.79 10H5.21zM19 11.5s-2 2.17-2 3.5c0 1.1.9 2 2 2s2-.9 2-2c0-1.33-2-3.5-2-3.5z"/><path fill-opacity=".36" d="M0 20h24v4H0z"/></svg>',
                    action: 'colorfill',
                    attr: { // attributes
                        title: 'Background color',
                    },
                },
                {
                    icon: '<span class="fa fa-subscript"></span>', // font-awesome demo
                    action: 'subscript',
                    attr: { // attributes
                        title: 'Subscript',
                    },
                },
                {
                    icon: '<span class="fa fa-superscript"></span>', // font-awesome demo
                    action: 'superscript',
                    attr: { // attributes
                        title: 'Superscript',
                    },
                },
                {
                    icon: '<span class="fa fa-list-ol"></span>', // font-awesome demo
                    action: 'orderedlist',
                    attr: { // attributes
                        title: 'Ordered list',
                    },
                },
                {
                    icon: '<span class="fa fa-list-ul"></span>', // font-awesome demo
                    action: 'unorderedlist',
                    attr: { // attributes
                        title: 'Unordered list',
                    },
                },
                {
                    icon: '<span class="fa fa-eraser"></span>', // font-awesome demo
                    action: 'clearformat',
                    attr: { // attributes
                        title: 'Remove format',
                    },
                },
            ];

            var interceptenter = function()
            {
                return false;
            };

            var editor1_commands = wysiwyg( '#editor1', {
                toolbar: 'top',
                buttons: buttons.slice(1),
                interceptenter: interceptenter,
                hijackmenu: true
            });
        });
    </script>
@endsection