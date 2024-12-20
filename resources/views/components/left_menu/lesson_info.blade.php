<div class="menu_item content_item lesson_info no_display">
    <h2>Информация о уроке</h2>
        <table>
            <tr>
                <td>№</td>
                <td>#<span class="id"></span></td>
            </tr>
            <tr>
                <td>Имя</td>
                <td class="name"></td>
            </tr>
            <tr>
                <td>Статус</td>
                <td class="status"></td>
            </tr>
            <tr>
                <td>Дата</td>
                <td class="date"></td>
            </tr>
            <tr>
                <td>Время</td>
                <td class="time"></td>
            </tr>
            <tr>
                <td>Баланс</td>
                <td class="balance" title="150"></td>
            </tr>
        </table>
        <div class="buttons">
            <form
                action="{{route('calendar.lesson_info_event')}}"
                id="lesson_info_event"
                method="post"
            >
                @csrf
                <input type="hidden" name="id" value="1">
                <input type="hidden" name="calendar_id" value="1">
{{--                <input type="hidden" name="" value="">--}}
            </form>
            <button title="Отменить" onclick="lesson_info_events(3, 'lesson_info_event')" class="button success closed"><img src="{{asset("res/arrow-rotate-left-solid.svg")}}" alt=""></button>
            <button title="Редактировать" onclick="lesson_info_events(0, 'lesson_info_event')" class="button normal" type="submit"><img src="{{asset("res/pencil-solid.svg")}}" alt=""></button>
            <button title="Провести" onclick="lesson_info_events(1, 'lesson_info_event')" class="button normal background_calendar_success"><img src="{{asset("res/Check.svg")}}" alt=""></button>
            <button title="Отменить" onclick="lesson_info_events(2, 'lesson_info_event')" class="button normal background_calendar_no_check"><img src="{{asset("res/Dead.svg")}}" alt=""></button>
        </div>
</div>
