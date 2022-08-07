@extends('layouts.app')
@section('class_name', "")
@section('page_name', "calendar_page")

@section('content')
    <div class="payed">
        <form action="">
            <h2>Пополнить за реквезитами</h2>
            <div class="card_input">
                <div class="header_input">
                    <h3>ПриватБанк</h3>
                    <p>Карта "Універсальна"</p>
                </div>
                <div class="numbers">
                    <label><input required maxlength="4" minlength="4" type="text" placeholder="XXXX"></label>
                    <label><input required maxlength="4" minlength="4" type="text" placeholder="XXXX"></label>
                    <label><input required maxlength="4" minlength="4" type="text" placeholder="XXXX"></label>
                    <label><input required maxlength="4" minlength="4" type="text" placeholder="XXXX"></label>
                </div>
                <div class="data">
                    <p>UNIVERSAL</p>
                    <div class="data_name">
                        <p>EXPIRES END</p>
                        <label><input required maxlength="2" minlength="2" type="text" placeholder="00"></label>
                        <span>/</span>
                        <label><input required maxlength="2" minlength="2" type="text" placeholder="00"></label>
                    </div>
                    <img class="logo_card" src="{{asset('res/mastercad.svg')}}" alt="">
                </div>

            </div>
        </form>
        <div>
            <h2>Выбрать другой способ оплаты</h2>
            <ul>
                <li>
                    <img src="" alt="">
                    <p>Терминал</p>
                </li>
                <li>
                    <img src="" alt="">
                    <p>Кнопка</p>
                </li>
                <li>
                    <img src="" alt="">
                    <p>Уже оплатили</p>
                </li>
            </ul>
        </div>
    </div>
@stop
@section('aside')@stop
@section('script')@stop
