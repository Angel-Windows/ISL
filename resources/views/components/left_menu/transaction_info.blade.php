<div class="menu_item content_item  transaction_info no_display">
    <h2>Трансакция</h2>
    <table>
        <tr>
            <td>№</td>
            <td>#<span class="id"> ... </span></td>
        </tr>
        <tr>
            <td>Студент</td>
            <td class="student_name"> ... </td>
        </tr>
        <tr>
            <td>Тип</td>
            <td class="type"> ... </td>
        </tr>
        <tr>
            <td>Статус</td>
            <td class="status"> ... </td>
        </tr>
        <tr>
            <td>Баланс</td>
            <td class="balance" title="150"> ... </td>
        </tr>
        <tr>
            <td>Сума</td>
            <td class="amount"> ... </td>
        </tr>
    </table>
    <div class="buttons">
        <form
            action="{{route('transaction.transaction_info_event')}}"
            id="transaction_info_event"
            method="post"
        >
            @csrf
            <input type="hidden" name="id" value="id">
            <input type="hidden" name="calendar_id" value="1">
            {{--                <input type="hidden" name="" value="">--}}
        </form>
        <button onclick="info_events(0, 'transaction_info_event')" class="button background_calendar_info" type="submit"><img
                src="{{asset("res/info_icon.png")}}" alt=""></button>
{{--        <button onclick="info_events(0, 'transaction_info_event')" class="button background_calendar_success"><img--}}
{{--                src="{{asset("res/Check.svg")}}" alt=""></button>--}}
        <button onclick="info_events(1, 'transaction_info_event')" class="button background_calendar_success"><img
                src="{{asset("res/Check.svg")}}" alt=""></button>
        <button onclick="info_events(2, 'transaction_info_event')" class="button background_calendar_no_check"><img
                src="{{asset("res/Dead.svg")}}" alt=""></button>
    </div>
</div>
