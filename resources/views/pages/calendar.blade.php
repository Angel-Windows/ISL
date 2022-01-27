<!doctype html>
<html lang="ru">
<head>
    {{--  https://fonts.google.com/share?selection.family=Noto%20Sans%7CNoto%20Sans%20Display:wght@200;300;500;600  --}}
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Noto+Sans+Display:wght@200;300;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Календарь</title>
</head>
<body>
<nav class="nav">
    <article>
        <div class="logo">
            <div class="img"><img src="{{asset("res/logo.svg")}}" alt="logo"></div>
            <h1>IT Schoollearn</h1>
        </div>
        <aside class="nav_list">
            @foreach($data as $item)
                <a href="{{route($item->link)}}" @if($route_name == $item->link) class="active" @endif>
                    <div class="img"><img src="{{asset('res/nav_itmem_home.png')}}" alt=""></div>
                    <em>{{$item->name}}</em>
                </a>
            @endforeach
        </aside>
    </article>
    <footer class="footer">
        <div class="settings">
            <div class="img light" onclick="changeTheme()"><img src="{{asset('res/light.png')}}" alt=""></div>
            <div class="language">
                <div class="img"><img src="{{asset('res/language.png')}}" alt=""></div>
                <p>Ru</p>
            </div>
        </div>
        <ul class="links">
            <li class="img"><img src="{{asset('res/language.png')}}" alt=""></li>
            <li class="img"><img src="{{asset('res/language.png')}}" alt=""></li>
            <li class="img"><img src="{{asset('res/language.png')}}" alt=""></li>
        </ul>
    </footer>
</nav>
<section>
    <aside class="menu_top">
        <div class="menu_nav">
            <div class="today">
                <div class="img"><img src="{{asset('res/arrow_left.png')}}" alt=""></div>
                <span>Today</span>
                <div class="img"><img src="{{asset('res/arrow_right.png')}}" alt=""></div>
            </div>
            <div class="work">
                <div class="img"><img src="{{asset('res/plus.png')}}" alt=""></div>
                <span>Work</span>
            </div>
            <div class="statistic">
                <div class="img"><img src="{{asset('res/statistic.png')}}" alt=""></div>
                <span>Statistic</span>
            </div>
        </div>
        <div class="menu_profile">
            <div class="coin"><div class="img"><img src="" alt=""></div></div>
            <div class="profile img"></div>
        </div>
    </aside>
    <div class="content calendar">
        <section>

        </section>
        <aside class="menu_right">

        </aside>
    </div>
</section>
<script src="{{asset('js/nav_left.js')}}"></script>
</body>
</html>
