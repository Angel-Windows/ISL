<div class="menu_item content_item  transaction_info no_display">
    <h2>Информация о уроке</h2>
    <table>
        <tr>
            <td>id</td>
            <td>#<span class="id">1</span></td>
        </tr>
        <tr>
            <td>Студент</td>
            <td class="name">Софа Селеменева</td>
        </tr>
        <tr>
            <td>Тип</td>
            <td class="date">Проведение урока</td>
        </tr>
        <tr>
            <td>Статус</td>
            <td class="time">Подтверждено</td>
        </tr>
        <tr>
            <td>Баланс</td>
            <td class="balance" title="150">400</td>
        </tr>
        <tr>
            <td>Сума</td>
            <td class="amount">400</td>
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
        <button onclick="lesson_info_events(0, 'lesson_info_event')" class="button " type="submit"><img
                src="{{asset("res/pencil-solid.svg")}}" alt=""></button>
        <button onclick="lesson_info_events(1, 'lesson_info_event')" class="button background_calendar_success"><img
                src="{{asset("res/Check.svg")}}" alt=""></button>
        <button onclick="lesson_info_events(2, 'lesson_info_event')" class="button background_calendar_no_check"><img
                src="{{asset("res/Dead.svg")}}" alt=""></button>
    </div>
</div>
