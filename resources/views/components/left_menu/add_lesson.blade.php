<?php
/** @var TYPE_NAME $item */
/** @var TYPE_NAME $filter */
?>
<div class="menu_item content_item add_lesson no_display">
    <h2>Добавить урок</h2>
    <form
        method="POST"
        action="{{route('calendar.add_lesson')}}"
        onsubmit='add_lesson(this); return false'
    >
        @csrf
        <table>
            <tr>
                <td><label for="student_id">Студент</label></td>
                <td>
                    <select name="student_id" required id="student_id" type="text">
                        @foreach($data_students as $key=>$item)
                            <option value="{{$item->id}}">{{$item->name}} {{$item->last_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="date">Дата</label></td>
                <td><input name="date" value="{{$date_now->format("Y-m-d")}}" id="date" type="date" required></td>
            </tr>
            <tr>
                <td><label for="time">Время</label></td>
                <td><input name="time" value="{{$date_now->format("h")}}:00" id="time" type="time" required></td>
            </tr>
            <tr>
                <td><label for="length">Длительность</label></td>
                <td><input name="length" id="length" type="number" value="60" step="30" min="60" max="120" required></td>
            </tr>
            <tr>
                <td><label for="is_regular">Постоянный</label></td>
                <td><input name="is_regular" id="is_regular" type="checkbox"></td>
            </tr>
        </table>
        <div class="buttons">
            <button class="button" type="submit">Подтвердить</button>
            <button type="button" class="success">Отменить</button>
        </div>
    </form>
</div>
