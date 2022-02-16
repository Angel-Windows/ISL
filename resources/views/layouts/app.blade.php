<?php
session_start();
?>
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Noto+Sans+Display:wght@200;300;500;600&display=swap"
        rel="stylesheet">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Scripts -->
    <script defer src="{{asset('js/global.js')}}"></script>
    <script defer src="{{asset('js/nav_left.js')}}"></script>
    <script defer src="{{asset('js/menu_right.js')}}"></script>
</head>
<body>
<nav class="nav">
    <article>
        <div class="logo">
            <div class="img"><img draggable="false" src="{{asset("res/logo.svg")}}" alt="logo"></div>
            <h1>IT Schoollearn</h1>
        </div>
        <aside class="nav_list">
            @foreach($data_navigation as $item)
                <a href="{{route($item->link)}}" @if($route_name == $item->link) class="active" @endif>
                    <div class="img"><img draggable="false" src="{{asset('res/nav_itmem_home.png')}}" alt=""></div>
                    <em>{{$item->name}}</em>
                </a>
            @endforeach
        </aside>
    </article>
    <footer class="footer">
        <div class="settings">
            <div class="img light" onclick="changeTheme()"><img src="{{asset('res/light.png')}}" alt=""></div>
            <div class="language">
                <div class="img"><img draggable="false" src="{{asset('res/language.png')}}" alt=""></div>
                <p>Ru</p>
            </div>
        </div>
        <ul class="links">
            <li class="img"><img draggable="false" src="{{asset('res/Telegram.svg')}}" alt=""></li>
            <li class="img"><img draggable="false" src="{{asset('res/Discord.svg')}}" alt=""></li>
            <li class="img"><img draggable="false" src="{{asset('res/Skype.svg')}}" alt=""></li>
        </ul>
    </footer>
</nav>
<section class="section  @yield('class_name')">
    @yield('content')
</section>
</body>
</html>
