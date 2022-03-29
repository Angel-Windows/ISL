<?php
/** @var TYPE_NAME $item */
/** @var TYPE_NAME $filter */
?>
<div class="content_item add_lesson">
    <h2>Добавить урок</h2>
    <form
        method="POST"
        action="{{route('calendar.add_lesson')}}"
        onsubmit='add_lesson(this); return false'
    >
        @csrf
        <table>
            <tr>
                <td><label for="">Студент</label></td>
                <td>
                    <select name="student_id" required id="" type="text">
                        <option value="1">Иванов Иван</option>
                        <option value="2">Макс Сверида</option>
                        <option value="3">Асталависта</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="">Дата</label></td>
                <td><input name="date" value="{{$date_now->format("Y-m-d")}}" id="" type="date" required></td>
            </tr>
            <tr>
                <td><label for="">Время</label></td>
                <td><input name="time" value="{{$date_now->format("h")}}:00" id="" type="time" required></td>
            </tr>
            <tr>
                <td><label for="">Длительность</label></td>
                <td><input name="length" id="" type="number" value="60" step="30" min="60" max="120" required></td>
            </tr>
            <tr>
                <td><label for="">Постоянный</label></td>
                <td><input name="regular" id="" type="checkbox"></td>
            </tr>
        </table>
        <div class="buttons">
            <button class="button" type="submit">Подтвердить</button>
            <button class="success">Отменить</button>
        </div>
    </form>
</div>

