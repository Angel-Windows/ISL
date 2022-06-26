@extends('layouts.app')
@section('class_name', "calendar_page")
@section('page_name', "calendar")
@section('content')
    <?php
    $arr_day_name = [null, "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];
    ?>
    <div class="calendar_new">
        <div class="no_display">
            <div class="lesson_item">
                <div class="count"></div>
                <p class="name"></p>
                <p class="lessons_time"></p>
            </div>
        </div>

        @for($i = 0; $i<8;$i++)
            <?php
            $name_day = "";
            if (!$i) {
                $name_day = "sub_day";
            }
            ?>
            <div class="day {{$name_day}}">
                <div class="day_name">
                    @if($arr_day_name[$i])
                        <p>{{$arr_day_name[$i]}}</p>
                        <p>{{$data_day_time[$i-1]}}</p>
                    @endif
                </div>
                @for($j = 0; $j<24;$j++)

                    <div class="time_item">
                        @if($j >= 0 && !$i)
                            <?php
                            $test = 0;
                            if ($j < 10) {
                                $test = "0" . $j . ":00";
                            } else {
                                $test = $j . ":00";
                            }
                            ?>
                            <span>{{$test}}</span>
                        @endif
                    </div>
                @endfor
            </div>
        @endfor
    </div>
@stop
@section('aside')
    @include('components.left_menu.lesson_info')
@stop

@section('script')
    <script src="{{asset('js/calendar.js')}}"></script>
    <script>
        calendar_fill_new(<?php echo($data_lesson) ?>, @json($filter));
    </script>
@stop
