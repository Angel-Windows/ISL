/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/menu_right.js ***!
  \************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var popup_top = document.querySelector('.popup_top');
var timeout_popup;

window.calendar_filter = function (url, id, elem) {
  var table = document.querySelector('.calendar_table');
  table.classList.add('progress_reload');
  var filter_data = elem.querySelector('.img');
  var filter_name = filter_data.classList[1];
  var filter_item = table.querySelectorAll('.' + filter_name);
  filter_item.forEach(function (item) {
    item.classList.toggle('no_display');
  });
  elem.classList.toggle('check');
  elem.classList.toggle('no_check');
  table.classList.remove('progress_reload');

  var func = function func() {};

  var parameters = {
    'id': id
  };
  Post(url, func, parameters);
};

window.add_lesson = function (form) {
  form.classList.add('progress_reload');

  var func = function func() {
    form.classList.remove('progress_reload');
  };

  PostForm(form, func);
};

window.lesson_info_events = function (e, form_name) {
  var form = document.getElementById(form_name);
  var id = document.querySelector(".lesson_info .id").innerHTML;
  var new_input = [{
    name: "event",
    value: e
  }, {
    name: "id",
    value: id
  }];
  create_html("input", new_input, form);

  var func = function func(res) {
    var calendar_item = document.querySelector('#calendar_' + id);

    if (res.code === 1) {
      calendar_item.className = "item background_calendar_success";
      popup_top.classList.remove('error');
    } else {
      calendar_item.className = "item background_calendar_success";
      popup_top.classList.add('error');
    }

    popup_top.innerHTML = res.message;
    popup_top.classList.add("open");
    clearTimeout(timeout_popup);
    timeout_popup = setTimeout(function () {
      popup_top.classList.remove("open");
    }, 3000);
  };

  PostForm(form, func);
};

window.change_menu_right = function () {
  var right_menu_active;
  var menu_right_fool = document.querySelectorAll(".menu_item");

  switch (localStorage.getItem("menu_right")) {
    case "1":
      right_menu_active = document.querySelectorAll(".info");
      break;

    case "2":
      right_menu_active = document.querySelectorAll(".add_lesson");
      break;

    case "3":
      right_menu_active = document.querySelectorAll(".lesson_info");
      break;

    case "4":
      right_menu_active = document.querySelectorAll(".transaction_info");
      break;

    default:
      console.log("no active " + localStorage.getItem("menu_right"));
      return false;
  }

  _toConsumableArray(menu_right_fool).forEach(function (item) {
    item.classList.add("no_display");
  });

  _toConsumableArray(right_menu_active).forEach(function (item) {
    item.classList.remove("no_display");
  });
};

window.menu_right_open = function (e) {
  target_menu_right(e);
};

window.lesson_info_open = function (e) {
  var url = e.querySelector("input[name='url']").value;
  var lesson_infos = document.querySelector('.lesson_info');
  lesson_infos.classList.add('progress_reload');

  var func = function func(response) {
    target_menu_right(3);
    var balance = lesson_infos.querySelector('.balance');
    var price_lesson = response.data.price_lesson;
    lesson_infos.querySelector('.id').innerHTML = response.data.id;
    lesson_infos.querySelector('.name').innerHTML = response.data.name;
    lesson_infos.querySelector('.date').innerHTML = response.data.date;
    lesson_infos.querySelector('.time').innerHTML = response.data.time;
    balance.innerHTML = response.data.balance;
    balance.title = price_lesson;
    lesson_infos.classList.remove('progress_reload');
    localStorage.setItem('menu_right', 1);
  };

  var parameters = {
    'id': e.querySelector("input[name='id']").value
  };
  Post(url, func, parameters);
};

window.transaction_info_open = function (from) {
  var transaction_info = document.querySelector('.transaction_info');
  target_menu_right(4);
  var balance = transaction_info.querySelector('.balance');
  balance.innerHTML = from.querySelector('.amount').innerHTML;

  var func = function func(response) {// const {price_lesson} = response.data;
    // lesson_infos.querySelector('.id').innerHTML = response.data.id
    // lesson_infos.querySelector('.name').innerHTML = response.data.name
    // lesson_infos.querySelector('.date').innerHTML = response.data.date
    // lesson_infos.querySelector('.time').innerHTML = response.data.time
    // balance.title = price_lesson
    // lesson_infos.classList.remove('progress_reload')
    // localStorage.setItem('menu_right', 1);
  }; // const parameters = {
  //     'id': e.querySelector("input[name='id']").value
  // }
  // Post(url, func, parameters);

};

window.target_menu_right = function (target) {
  localStorage.setItem('menu_right', target);
  change_menu_right();
};

change_menu_right();
/******/ })()
;