@extends('layouts.app')
@section('class_name', "calendar_page")
@section('content')
    <?php
    $data_status = ['Ожидание', "Подтверждено", 'Отменено'];
    $data_type = ['Урок', "Возврат", 'Пополнение'];
    ?>
    <div class="content transactions">
        <table class="list">
            <thead>
            <tr class="round-top">
                <th></th>
                <th>Студент</th>
                <th>Профессор</th>
                <th>Сума</th>
                <th>Тип</th>
                <th>Статус</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_transactions as $key=>$item)
                <?php
                $round_top = "";
                if ($key == 0) {
                    $round_top = "round-top";
                }
                ?>
                <tr onclick="transaction_info_open(this)">
                    <td class="{{$round_top ?? ""}} id">{{$item->id}}</td>
                    <td class="student_name">{{$item->student_first_name}} {{$item->student_last_name}}</td>
                    <td class="professor_name">{{$item->professor_first_name}} {{$item->professor_last_name}}</td>
                    <td class="amount" title="Сумма: {{$item->new_balance}}">{{$item->amount}}</td>
                    <td class="type">{{$data_type[$item->type]}}</td>
                    <td class="status">{{$data_status[$item->status]}}</td>
                    <td class="created_at">{{$item->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <aside class="menu_right">
            @include('components.left_menu.add_lesson')
            @include('components.left_menu.transaction_info')
        </aside>
    </div>
@stop
