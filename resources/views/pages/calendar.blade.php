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
            @foreach($data_navigation as $item)
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
<section class="section">
    <aside class="menu_top">
        <div class="menu_nav">
            <div class="today item_menu">
                <a href="{{route($route_name, ['page'=>($page-1)])}}" class="img"><img
                        src="{{asset('res/arrow_left.png')}}" alt=""></a>
                <a href="{{route($route_name, ['page'=>0])}}"><span>Today</span></a>
                <a href="{{route($route_name, ['page'=>($page+1)])}}" class="img"><img
                        src="{{asset('res/arrow_right.png')}}" alt=""></a>
            </div>
            <div class="work item_menu">
                <div class="img"><img src="{{asset('res/plus.png')}}" alt=""></div>
                <span>Work</span>
            </div>
            <div class="statistic item_menu">
                <div class="img"><img src="{{asset('res/statistic.png')}}" alt=""></div>
                <span>Statistic</span>
            </div>
            <h2 class="item_menu">Расписание {{$now_data}}</h2>
        </div>
        <div class="menu_profile">
            <div class="coin">
                <div class="img"><img src="{{asset('res/sc.png')}}" alt=""></div>
                <span>15600</span>
            </div>
            <div class="profile_avatar img"><img src="{{asset('res/avatara_user.png')}}" alt=""></div>
        </div>
    </aside>
    <div class="content calendar">
        <table>
            <col class="col1 unselectable">
            <col span=1 class="coln unselectable">
            <thead>
            <tr>
                <th></th>
                <th>Пн</th>
                <th>Вт</th>
                <th>Ср</th>
                <th>Чт</th>
                <th>Пт</th>
                <th>Сб</th>
                <th>Вс</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $temp_data_lesson = $data_lesson;
            $data_day = [1, 2, 3, 4, 5, 6, 0];
            ?>
            @for($i = 9; $i<=22;$i++)
                <tr>
                    <?php
                    if ($i < 10) {
                        $num_day = "0" . $i;
                    } else {
                        $num_day = $i;
                    }
                    $num_day .= ":00"
                    ?>
                    <td class="time">{{$num_day}}</td>
                    @for($j = 0; $j < 7; $j++)
                        <td>
                            @foreach($temp_data_lesson as $key=>$item)
                                @if($item->day_week == $data_day[$j] &&  $item->time_start == $num_day.":00")
                                    <?php
                                    $class_names = '';
                                    switch ((int)$item->status) {
                                        case 0:
                                            $class_names = "normal";
                                            break;
                                        case 1:
                                            $class_names = "closed";
                                            break;
                                        case 2:
                                            $class_names = "transfer";
                                            break;
                                        case 3:
                                            $class_names = "success";
                                            break;
                                        default :
                                            $class_names = 'delete';
                                            break;
                                    }
                                    ?>
                                    <div class="item {{$class_names}}">
                                        <p>{{$item->student_name}}</p>
                                        <p>{{$num_day}} - {{$i + 1 . ":00"}}</p>
                                    </div>
                                    <?php unset($temp_data_lesson[$key]); ?>
                                @endif
                            @endforeach
                        </td>
                    @endfor
                </tr>
            @endfor
            </tbody>
        </table>
        <aside class="menu_right">
        </aside>
    </div>
</section>
<script src="{{asset('js/nav_left.js')}}"></script>
</body>
</html>
