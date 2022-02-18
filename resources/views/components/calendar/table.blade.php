<?php
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

$data_status = [
    [
        'id' => 0,
        'name' => "Проведенный",
        'class' => 'background_calendar_success'
    ], [
        'id' => 1,
        'name' => "Постоянный",
        'class' => 'background_calendar_normal'
    ], [
        'id' => 2,
        'name' => "Перенесенный",
        'class' => 'background_calendar_transfer'
    ], [
        'id' => 3,
        'name' => "Отмененный",
        'class' => 'background_calendar_closed'
    ], [
        'id' => 4,
        'name' => "Не отмеченный",
        'class' => 'background_calendar_no_check'
    ]
];

$data_day = [1, 2, 3, 4, 5, 6, 0];
$arr_data_name = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
?>
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
                        @if($item->day_week == $data_day[$j+$start_temp-1] &&  $item->time_start == $num_day.":00")
                            <div class="item {{$data_status[$item->status-1]['class']}}">
                                <p>{{$item->student_name}}</p>
                                <p>{{$num_day}} - {{$i + 1 . ":00"}}</p>
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
