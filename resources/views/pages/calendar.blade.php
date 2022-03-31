@extends('layouts.app')
@section('class_name', "calendar_page")
@section('content')
    <?php
    /** @var TYPE_NAME $data_lesson */
    /** @var TYPE_NAME $start_day_week */
    /** @var TYPE_NAME $page */
    /** @var TYPE_NAME $filter */

    $count_day_week = session('count_day_week') ?? 7;

    $temp_data_lesson = $data_lesson;
    $start_temp = $start_day_week;

    $next_page_start = ['page' => ($page + 1), 'start' => 1];
    $back_page_start = ['page' => ($page - 1), 'start' => 1];
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
        } else {
            $next_page_start['start'] = 2;
            $next_page_start['page'] = $page;
            $back_page_start['start'] = 2;
            $start_temp = 1;
        }
    }

    $data_status = $filter;
    $data_day = [1, 2, 3, 4, 5, 6, 0];
    $arr_data_name = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
    ?>

    <div class="content calendar">
        <table class="calendar_table">
            <col class="col1 unselectable">
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
                                @if($item->day_week == $data_day[$j+$start_temp-1] &&  date('H',strtotime($item->time_start)) == date('H',strtotime($num_day)))
                                    <?php
                                    if (count($data_status)) {
                                        $class_list_item = $data_status[$item->status]->class;
                                        if (!$data_status[$item->status]->display) {
                                            $class_list_item .= " no_display";
                                        }
                                    } else {
                                        $class_list_item = "background_calendar_normal";
                                    }
                                    ?>
                                    <div class="item {{$class_list_item}}">
                                        <p>{{$item->student_name}}</p>
                                        <p>{{date('H:i',strtotime($item->time_start))}}
                                            - {{date('H:i', (strtotime($item->time_start)+3600))}}</p>
                                    </div>
                                    <?php unset($temp_data_lesson[$key ?? 0]); ?>
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
            {{-- @include('components.left_menu.add_lesson')--}}
            @include('components.left_menu.lesson_info')
        </aside>
    </div>
@stop
