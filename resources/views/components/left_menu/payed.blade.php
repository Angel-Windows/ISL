<?php
/** @var TYPE_NAME $item */
/** @var TYPE_NAME $filter */
?>
<div class="menu_item content_item payed_naw no_display">
    <h2>Добавить урок</h2>
    <form
        method="POST"
        action="{{route('payed.store')}}"
        onsubmit='add_payed(this); return false'
    >
        @csrf
        <div>
            <label for="user_payed">Кому</label>
            <select name="user_payed" id="user_payed">
                <option>Себе любимому</option>
                @foreach($data_students as $item)
                    <option value="{{$item->user_id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <label for="amount">Сумма</label>
            <input name="amount" id="amount" type="number" step="1" min="1" max="500000" required>
        </div>
        <div class="buttons">
            <button class="button" type="submit">Подтвердить</button>
            <button type="button" class="success">Отменить</button>
        </div>
    </form>
</div>
