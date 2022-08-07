@extends('layouts.app')
@section('class_name', "transaction_page")
@section('page_name', "transaction_page")
@section('content')
    <?php
    $data_statuss = ['Ожидание', "Подтверждено", 'Отменено'];
    $data_type = ['Урок', "Отмена", 'Пополнение'];
    ?>
    <script>
        const data_status = ['Ожидание', "Подтверждено", 'Отменено'];
        const data_type = ['Урок', "Отмена", 'Пополнение'];
    </script>
    <div class="contents transactions">
        <table class="list">
            <thead>
            <tr class="round-top">
                <th class="id"></th>
                <th class="student_name">Студент</th>
                <th class="professor_name">Профессор</th>
                <th class="amount">Сума</th>
                <th class="type">Тип</th>
                <th class="status">Статус</th>
                <th class="created_at">Дата</th>
                <th class="no_display balance"></th>
            </tr>
            <tr onclick="transaction_info_open(this)" class="default_list no_display">
                <td class="id"></td>
                <td class="student_name"></td>
                <td class="professor_name"></td>
                <td class="amount"></td>
                <td class="type"></td>
                <td class="status"></td>
                <td class="created_at"></td>
                <td class="no_display balance"></td>
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
                <tr onclick="transaction_info_open(this)" >
                    <td class="{{$round_top ?? ""}} id">{{$item->id}}</td>
                    <td class="student_name">{{$item->student_name?? "Я"}}</td>
{{--                    <td class="student_name">{{$item->student_first_name}} {{$item->student_last_name}}</td>--}}
                    <td class="professor_name">{{$item->professor_name}}</td>
{{--                    <td class="professor_name">{{$item->professor_first_name}} {{$item->professor_last_name}}</td>--}}
                    <td class="amount">{{$item->amount}}</td>
                    <td class="type">{{$data_type[$item->type]}}</td>
                    <td class="status">{{$data_statuss[$item->status]}}</td>
                    <td class="created_at">{{$item->created_at}}</td>
                    <td class="no_display balance">{{$item->balance}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop

@section('aside')
    @include('components.left_menu.add_lesson')
    @include('components.left_menu.transaction_info')
@stop

@section('script')
    <script src="{{asset('js/calendar.js')}}"></script>
    <script>

    </script>
@stop
