@extends('layouts.app')
@section('class_name', "admin_page")
@section('page_name', "admin")

@section('content')
    <div class="admin_content">
        <h2>Админ</h2>
        <form action="{{route('admin.create_student_store')}}" method="post">
            @csrf
            <label>
                <span>Имя</span>
                <input type="text" name="name" placeholder="Имя...">
            </label>
            <label>
                <span>E-mail</span>
                <input type="email" name="email" placeholder="E-mail...">
            </label>
            <label>
                <span>Пол</span>
                <input type="text" name="gender" placeholder="Пол...">
            </label>
            <label>
                <span>Цена урока</span>
                <input type="text" name="price" placeholder="Стоимость урока...">
            </label>
            <button type="submit">Отправить</button>
        </form>
    </div>
@stop
@section('aside')
{{--    @include('components.left_menu.lesson_info')--}}
@stop

@section('script')
    <script>
    </script>
@stop
