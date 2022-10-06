Урок id: <code>{{$id}}</code>
<b>Преподаватель: </b> <code>{{$professor}}</code>
<b>Ученик: </b> <code>{{$student}}</code>
<b>День: </b> <code>{{$day}}</code>
<b>Время: </b> <code>{{$time}}</code>
@if(Auth::user())
    <b>Ползователь: </b> <a href="t.me/{{Auth::user()->telegram_username}}">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>
@endif
