<?php
session_start();
$route = \Request::route()->getName();
$page_get = $_GET['page'] ?? 1;
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
    <script src="https://kit.fontawesome.com/55683bb2a9.js" crossorigin="anonymous"></script>

    <script defer src="{{asset('js/global.js')}}"></script>
    <script defer src="{{asset('js/nav_left.js')}}"></script>
    <script defer src="{{asset('js/menu_right.js')}}"></script>
</head>
<body id="body" class="body">
<main>
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
        <aside class="menu_top">
            <div class="menu_nav">
                @if($route == "calendar")
                    <div class="today item_menu">
                        <a href="{{route($route_name, $back_page_start)}}"
                           class="img"><img draggable="false"
                                            src="{{asset('res/arrow_left.png')}}" alt=""></a>
                        <a href="{{route($route_name)}}"><span>Today</span></a>
                        <a href="{{route($route_name, $next_page_start)}}"
                           class="img"><img draggable="false"
                                            src="{{asset('res/arrow_right.png')}}" alt=""></a>
                    </div>
                @else
                    <?php
                    $page_nav_left_class = "";
                    $page_nav_right_class = "";
                    if ($page_get <= 1) {
                        $page_nav_left_class = "disable";
                        }
                    if (count($data_transactions) < 10) {
                        $page_nav_right_class = "disable";
                    }
                    ?>
                    <div class="today item_menu">
                        <a href="{{route($route_name, ['page'=>$page_get-1])}}" class="img {{$page_nav_left_class}}">
                            <img draggable="false" src="{{asset('res/arrow_left.png')}}" alt="">
                        </a>
                        <a href="{{route($route_name, ['page'=>1])}}"><span>Начало</span></a>
                        <a href="{{route($route_name, ['page'=>$page_get+1])}}"
                           class="img {{$page_nav_right_class}}"><img draggable="false"
                                            src="{{asset('res/arrow_right.png')}}" alt=""></a>
                    </div>
                @endif
                <div onclick="menu_right_open(2)" class="work item_menu">
                    <div class="img"><img draggable="false" src="{{asset('res/plus.png')}}" alt=""></div>
                    <span>Work</span>
                </div>
                <a href="{{route("calendar", ['count_day_week' => 7])}}" class="statistic item_menu">
                    <div class="img"><img draggable="false" src="{{asset('res/statistic.png')}}" alt=""></div>
                    <span>Statistic</span>
                </a>
                @if($route == "calendar")
                    <h2 class="item_menu">Расписание {{$now_data}}</h2>
                @endif
            </div>
            <div class="menu_profile">
                <div class="coin">
                    <div class="img"><img draggable="false" src="{{asset('res/sc.png')}}" alt=""></div>
                    <span>15600</span>
                </div>
                <div class="profile_avatar img"><img draggable="false" src="{{asset('res/avatara_user.png')}}" alt="">
                </div>
            </div>
        </aside>
        @yield('content')
    </section>
</main>
<div onclick="menu_right_open(1)" class="burger_right"></div>
<div onclick="" class="popup_top">Сохранение прошло успешно</div>

</body>
</html>
