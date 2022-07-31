@extends('layouts.app')
@section('class_name', "calendar_page")
@section('page_name', "calendar")

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
    <div onclick="lesson_info_open(this)" id="calendar_"
         class="item no_display">
        <input type="hidden" name="id" value="s">
        <input type="hidden" name="url"
               value="{{route('calendar.get_lesson_info')}}">
        <p class="student_name"></p>
        <p class="time_lesson"></p>
    </div>
    <div class="calendar_wrapper">
        <table class="calendar_table">
            <col class="col1 unselectable">
            <thead class="unselectable">
            <tr>
                <th></th>
                @for($i=0; $i < $count_day_week; $i++)
                    <th>
                        {{$arr_data_name[$i+$start_temp-1]}}
                        <br>
                        <div class="data">{{$data_day_time[$i]}}</div>
                    </th>
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
                    $num_day_elem = $num_day;
                    $num_day .= ":00"
                    ?>
                    <td class="time unselectable">{{$num_day}}</td>
                    @for($j = 0; $j < $count_day_week; $j++)
                        <td>
                            <div class="calendar_item d{{$data_day_time[$j]}} t{{$num_day_elem}}"></div>
                        </td>
                    @endfor
                </tr>
            @endfor
            </tbody>
        </table>
    </div>

@stop
@section('aside')
    @include('components.left_menu.lesson_info')
@stop

@section('script')
    <script src="{{asset('js/calendar.js')}}"></script>
    <script>
        calendar_fill(<?php echo($data_lesson) ?>, @json($data_status));
    </script>
@stop
