<?php
/** @var TYPE_NAME $item */
/** @var TYPE_NAME $filter */
?>
<div class="menu_item content_item update_lesson no_display">
    <h2>Изменить урок</h2>
    <form
        method="POST"
        action="{{route('calendar.add_lesson')}}"
        onsubmit='add_lesson(this); return false'
    >
        @csrf
        <input type="hidden" name="id" class="id">
        <table>
            <tr>
                <td><label for="student_id_update">Студент</label></td>
                <td>
                    <span class="name" id="student_id_update">Пупсик Пупсиков</span>
                </td>
            </tr>
            <tr>
                <td><label for="date_update">Дата</label></td>
                <td><input class="date" name="date" value="{{$date_now->format("Y-m-d")}}" id="date_update" type="date" required></td>
            </tr>
            <tr>
                <td><label for="time_update">Время</label></td>
                <td><input class="time" name="time" value="{{$date_now->timezone(3)->format("h")}}:00" id="time_update" type="time" required></td>
            </tr>
            <tr>
                <td><label for="length_update">Длительность</label></td>
                <td><input class="length" name="length" id="length_update" type="number" value="60" step="30" min="60" max="120" required></td>
            </tr>
            <tr>
                <td><label for="is_regular_update">Постоянный</label></td>
                <td><input class="is_regular" name="is_regular" id="is_regular_update" type="checkbox"></td>
            </tr>
        </table>
        <div class="buttons">
            <button class="button" type="submit">Изменить</button>
            <button type="button" class="success">Венуться</button>
        </div>
    </form>
</div>
