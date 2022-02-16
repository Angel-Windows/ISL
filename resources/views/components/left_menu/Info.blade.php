<?php
/** @var TYPE_NAME $item */
/** @var TYPE_NAME $filter */
?>
<div class="content_item">
    <h2>Статистика</h2>
    <table class="info">
        <tr>
            <td>ID</td>
            <td>#DE3SAS5</td>
        </tr>
        <tr>
            <td>Всего уроков</td>
            <td>233</td>
        </tr>
        <tr>
            <td>Баланс</td>
            <td>233</td>
        </tr>
    </table>
    <div class="hr hr_horizontal"></div>
    <h2>Информация</h2>
    <table class="info">
        <tr>
            <td>Мобильный</td>
            <td><a href="tel:+380956686191">+(380) 9566-86-191</a></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><a href="eliphas.sn@gmail.com">eliphas.sn@gmail.com</a></td>
        </tr>
        <tr>
            <td>Skype</td>
            <td><a href="eliphas.sn@gmail.com">eliphas.sn@gmail.com</a></td>
        </tr>
    </table>
</div>
<div class="content_item">
    <h2>Фильтры <a href="" class="button hide">Применить</a></h2>
    <table class="filter">
        @foreach($data_status as $item)
            <?php
            $class_active = "";
            $img_link = asset('res/Check.svg');

            if (!in_array($item['id'], $filter)) {
                $class_active = "no_active";
                $img_link = asset('res/Dead.svg');
}
                ?>
            <tr onclick="calendar_filter('{{route('calendar.filters')}}', {{$item['id']}})">
                <td>
                    <div class="img {{$item['class']}} {{$class_active}}"><img src="{{$img_link}}" alt=""></div>
                </td>
                <td>{{$item['name']}}</td>
            </tr>
        @endforeach
        {{--        --}}
        {{--        <tr>--}}
        {{--            <td><div class="img background_calendar_transfer"><img src="{{asset('res/Check.svg')}}" alt=""></div></td>--}}
        {{--            <td><a href="">Постоянный</a></td>--}}
        {{--        </tr>--}}
        {{--        <tr>--}}
        {{--            <td><div class="img background_calendar_normal"><img src="{{asset('res/Check.svg')}}" alt=""></div></td>--}}
        {{--            <td><a href="">Перенесенный</a></td>--}}
        {{--        </tr>--}}
        {{--        <tr>--}}
        {{--            <td><div class="img background_calendar_closed"><img src="{{asset('res/Check.svg')}}" alt=""></div></td>--}}
        {{--            <td><a href="">Отмененный</a></td>--}}
        {{--        </tr>--}}
        {{--        <tr>--}}
        {{--            <td><div class="img background_calendar_no_check"><img src="{{asset('res/Check.svg')}}" alt=""></div></td>--}}
        {{--            <td><a href="">Не отмеченный</a></td>--}}
        {{--        </tr>--}}
    </table>
</div>
