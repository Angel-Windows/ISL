<?php
session_start();
$route = \Request::route()->getName();
$page_get = $_GET['page'] ?? 1;
?>
    <!DOCTYPE html>
<html lang="ru">
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url_info" content="{{ route('calendar.get_lesson_info') }}">

    {{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
    {{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
    {{--    <link--}}
    {{--        href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Noto+Sans+Display:wght@200;300;500;600&display=swap"--}}
    {{--        rel="stylesheet">--}}


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}

<!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset("res/favicon.svg")}}">
    <!-- Scripts -->
    {{--    <script src="https://kit.fontawesome.com/55683bb2a9.js" crossorigin="anonymous"></script>--}}

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
    <section class="section overflow-hidden  @yield('class_name')">
        <aside class="menu_top">
            <div class="menu_nav">
                @if($route == "calendar" || $route == "home"|| empty($_GET["page"]))
                    <?php if (empty($_GET["page"])) {
                        $_GET["page"] = 0;
                    } ?>
                    <div class="today item_menu">
                        <div class="item_container">
                            <a href="{{route($route_name, ['page' =>$_GET["page"]-1])}}"
                               class="img"><img draggable="false"
                                                src="{{asset('res/arrow_left.png')}}" alt=""></a>
                        </div>
                        <div class="item_container">
                            <a href="{{route($route_name)}}"><span>Today</span></a>
                        </div>
                        <div class="item_container">
                            <a href="{{route($route_name, ['page' =>$_GET["page"]+1])}}"
                               class="img"><img draggable="false"
                                                src="{{asset('res/arrow_right.png')}}" alt=""></a>
                        </div>
                    </div>
                @elseif($route == "transaction")
                    <?php
                    $page_nav_left_class = "";
                    $page_nav_right_class = "";
                    if ($page_get <= 1) {
                        $page_nav_left_class = "disable";
                    }
                    if (count($data_transactions ?? []) < 10) {
                        $page_nav_right_class = "disable";
                    }
                    ?>
                    <div class="today item_menu">
                        <div class="item_container">
                            <a href="{{route($route_name, ['page'=>$page_get-1])}}"
                               class="img {{$page_nav_left_class}}">
                                <img draggable="false" src="{{asset('res/arrow_left.png')}}" alt="">
                            </a>
                        </div>
                        <div class="item_container">
                            <a href="{{route($route_name, ['page'=>1])}}"><span>Начало</span></a>
                        </div>
                        <div class="item_container">
                            <a href="{{route($route_name, ['page'=>$page_get+1])}}"
                               class="img {{$page_nav_right_class}}"><img draggable="false"
                                                                          src="{{asset('res/arrow_right.png')}}" alt=""></a>
                        </div>
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
                    <div onclick="target_menu_right(5)" class="statistic item_menu">
                        <div class="img"><img draggable="false" src="{{asset('res/statistic.png')}}" alt=""></div>
                        <span>Пополнить</span>
                    </div>
                    <?php
                    $naw_item_menu = false;
                    switch($route){
                        case "calendar" :
                            $naw_item_menu = 'Расписание на ' . $now_data;
                            break;
                        case "home" :
                            $naw_item_menu = 'Главная страница';
                            break;
                        case "transaction" :
                            $naw_item_menu = 'Транзакции страница: ' . $_GET["page"];
                            break;
                            case "payed" :
                            $naw_item_menu = 'Пополнение';
                            break;
                    }

                    ?>
                @if($naw_item_menu)
                    <h2 class="item_menu">{{$naw_item_menu}}</h2>
                @endif
            </div>
            <div class="menu_profile">
                <div class="coin">
                    <div class="img"><img draggable="false" src="{{asset('res/sc.png')}}" alt=""></div>
                    <span>{{$user->balance}}</span>
                </div>
                <div class="profile_avatar img"><img draggable="false" src="{{asset('res/avatara_user.png')}}" alt="">
                    <ul class="menu_list">
                        <li><a href="#">Настройки</a></li>
                        <li><a href="{{route('payed')}}">Пополнение</a></li>
                        <li><a href="#">Трансакции</a></li>
                        <li><a href="#">Полезные материалы</a></li>
                        <li><a href="{{route('logout')}}">Выйти</a></li>
                    </ul>
                </div>
            </div>
        </aside>
        {{--        <div class="content">--}}
        <div class="content overflow-hidden @yield('page_name')">
            @yield('content')
            <aside class="menu_right">
                @include('components.left_menu.Info')
                @include('components.left_menu.add_lesson')
                @include('components.left_menu.payed')
                @yield('aside')
            </aside>
        </div>
    </section>

</main>
<div onclick="menu_right_open(1)" class="burger_right"></div>
<div onclick="" class="popup_top">Сохранение прошло успешно</div>
@yield('script')
</body>
</html>
