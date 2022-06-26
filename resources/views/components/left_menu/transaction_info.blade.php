<div class="menu_item content_item  transaction_info no_display">
    <h2>Трансакция</h2>
    <table>
        <tr>
            <td>№</td>
            <td>#<span class="id">1</span></td>
        </tr>
        <tr>
            <td>Студент</td>
            <td class="student_name">Софа Селеменева</td>
        </tr>
        <tr>
            <td>Тип</td>
            <td class="type">Проведение урока</td>
        </tr>
        <tr>
            <td>Статус</td>
            <td class="status">Подтверждено</td>
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
            action="{{route('transaction.transaction_info_event')}}"
            id="transaction_info_event"
            method="post"
        >
            @csrf
            <input type="hidden" name="id" value="1">
            <input type="hidden" name="calendar_id" value="1">
            {{--                <input type="hidden" name="" value="">--}}
        </form>
        <button onclick="info_events(0, 'transaction_info_event')" class="button " type="submit"><img
                src="{{asset("res/pencil-solid.svg")}}" alt=""></button>
        <button onclick="info_events(1, 'transaction_info_event')" class="button background_calendar_success"><img
                src="{{asset("res/Check.svg")}}" alt=""></button>
        <button onclick="info_events(2, 'transaction_info_event')" class="button background_calendar_no_check"><img
                src="{{asset("res/Dead.svg")}}" alt=""></button>
    </div>
</div>
