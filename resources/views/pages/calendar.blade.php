@extends('layouts.app')
@section('class_name', "calendar_page")
@section('content')
    <?php
    $count_day_week = session('count_day_week') ?? 7;

    $temp_data_lesson = $data_lesson;
    $start_temp = $start_day_week;

    $next_page_start = ['page'=>($page+1), 'start'=>1];
    $back_page_start = ['page'=>($page-1), 'start'=>1];
    if ($count_day_week == 4) {
        if ($start_temp == 1) {
            $next_page_start['start'] = 2;
            $next_page_start['page'] = $page;
            $back_page_start['start'] = 2;
            $start_temp = 1;
        } elseif ($start_temp == 2) {
            $next_page_start['start'] = 1;
            $back_page_start['start'] = 1;
            $back_page_start['page'] = $page;
            $start_temp = 4;
        }else{
            $next_page_start['start'] = 2;
            $next_page_start['page'] = $page;
            $back_page_start['start'] = 2;
            $start_temp = 1;
        }
    }



    $data_day = [1, 2, 3, 4, 5, 6, 0];
    $arr_data_name = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
    ?>
    <aside class="menu_top">
        <div class="menu_nav">
            <div class="today item_menu">
                <a href="{{route($route_name, $back_page_start)}}"
                   class="img"><img draggable="false"
                                    src="{{asset('res/arrow_left.png')}}" alt=""></a>
                <a href="{{route($route_name)}}"><span>Today</span></a>
                <a href="{{route($route_name, $next_page_start)}}"
                   class="img"><img draggable="false"
                                    src="{{asset('res/arrow_right.png')}}" alt=""></a>
            </div>
            <a href="{{route("calendar", ['count_day_week' => 1])}}" class="work item_menu">
                <div class="img"><img draggable="false" src="{{asset('res/plus.png')}}" alt=""></div>
                <span>Work</span>
            </a>
            <a href="{{route("calendar", ['count_day_week' => 7])}}" class="statistic item_menu">
                <div class="img"><img draggable="false" src="{{asset('res/statistic.png')}}" alt=""></div>
                <span>Statistic</span>
            </a>
            <h2 class="item_menu">Расписание {{$now_data}}</h2>
        </div>
        <div class="menu_profile">
            <div class="coin">
                <div class="img"><img draggable="false" src="{{asset('res/sc.png')}}" alt=""></div>
                <span>15600</span>
            </div>
            <div class="profile_avatar img"><img draggable="false" src="{{asset('res/avatara_user.png')}}" alt=""></div>
        </div>
    </aside>
    <div class="content calendar">
        <table class="calendar_table">
            <col class="col1 unselectable">
{{--            <col span=1 class="coln unselectable">--}}
            <thead class="unselectable">
            <tr>
                <th></th>
                @for($i=0; $i < $count_day_week; $i++)
                    <th>{{$arr_data_name[$i+$start_temp-1]}}</th>
                @endfor
            </tr>
            </thead>
            <tbody>

            @for($i = 9; $i<=22;$i++)
                <tr class="">
                    <?php
                    if ($i < 10) {
                        $num_day = "0" . $i;
                    } else {
                        $num_day = $i;
                    }
                    $num_day .= ":00"
                    ?>
                    <td class="time unselectable">{{$num_day}}</td>

                    @for($j = 0; $j < $count_day_week; $j++)
                        <td class="">
                            @foreach($temp_data_lesson as $key=>$item)
                                @if($item->day_week == $data_day[$j+$start_temp-1] &&  $item->time_start == $num_day.":00")
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
          @include('components.left_menu.Info')
        </aside>
    </div>
@stop
