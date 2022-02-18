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
            <td><a href="eliphas.sn@gmail.com">{!!"eliphas.sn@gmail.com"!!}</a></td>
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
            $class_checked = "";
            $img_link = asset('res/Check.svg');
            //            dd($item);
            //            if (!session()->has('filter')) {
            //                $class_active = "check";
            //            }
            //            else if (in_array($item->id, session("filter"))) {
            //                $class_active = "check";
            //            } else {
            //                $class_active = "no_check";
            //            }
            if ($item->display) {
                $class_active = "check";
            }else{
                $class_active = "no_check";
            }
            ?>
            <tr class="{{$class_active}}"
                onclick="calendar_filter('{{route('calendar.filters')}}', {{$item->id}}, this)">
                <td>
                    <div class="img {{$class_checked}} {{$item->class}} ">
                        <div class="mini_img"></div>
                    </div>
                </td>
                <td>{{$item->name}}</td>
            </tr>
        @endforeach
    </table>
</div>
