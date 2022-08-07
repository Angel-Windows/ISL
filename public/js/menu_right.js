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

window.calendar_filter = function (url, id, elem) {
  var table = document.querySelector('.transactions');

  if (!table) {
    table = document.querySelector('.calendar_new');
    table.classList.add('progress_reload');
    var filter_data = elem.querySelector('.img');
    var filter_name = filter_data.classList[1];
    var filter_item = table.querySelectorAll('.' + filter_name);
    filter_item.forEach(function (item) {
      item.classList.toggle('no_display');
    });
  } else {}

  var func = function func(request) {
    fill_transaction(request);
  };

  var parameters = {
    'id': id
  };
  Post(url, func, parameters);
  elem.classList.toggle('check');
  elem.classList.toggle('no_check');
  table.classList.remove('progress_reload');
};

function split_teg_ajax(tegs, modal_name) {
  var id = tegs[0].querySelector(".".concat(modal_name));
  var test;

  if (modal_name === 'created_at') {
    test = tegs[1][modal_name].replace(/[A-z]/g, ' ').substr(0, 19);
  } else if (modal_name === 'type') {
    test = data_type[tegs[1][modal_name]];
  } else if (modal_name === 'status') {
    test = data_status[tegs[1][modal_name]];
  } else {
    test = tegs[1][modal_name];
  }

  id.innerHTML = test; // id.innerHTML = tegs[1].(`.${modal_name}`).innerHTML;
}

function fill_transaction(request) {
  var transactions = document.querySelector('.transactions tbody');

  if (!transactions) {
    return false;
  }

  var transactions_default = document.querySelector('.transactions thead .default_list');
  transactions.innerHTML = "";
  request['new_data'].data.forEach(function (item) {
    var transactions_default_new = transactions_default.cloneNode(true);
    var tags = [transactions_default_new, item];
    split_teg_ajax(tags, 'id');
    split_teg_ajax(tags, 'student_name');
    split_teg_ajax(tags, 'professor_name');
    split_teg_ajax(tags, 'amount');
    split_teg_ajax(tags, 'type');
    split_teg_ajax(tags, 'status');
    split_teg_ajax(tags, 'created_at');
    split_teg_ajax(tags, 'balance');
    transactions_default_new.classList.remove("no_display");
    transactions.appendChild(transactions_default_new);
  });
}

window.add_payed = function (form) {
  form.classList.add('progress_reload');

  var func = function func(request) {
    form.classList.remove('progress_reload');
  };

  PostForm(form, func);
};

window.add_lesson = function (form) {
  form.classList.add('progress_reload');

  var func = function func(request) {
    form.classList.remove('progress_reload');
    calendar_add_item(request.data.item, request.data.filters);
  };

  PostForm(form, func);
};

window.info_events = function (e, form_name) {
  var form = document.getElementById(form_name);
  var id = document.querySelector(".transaction_info .id").innerHTML;
  var new_input = [{
    name: "event",
    value: e
  }, {
    name: "id",
    value: id
  }];
  create_html("input", new_input, form);

  var func = function func(res) {};

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
    var calendar_item = document.querySelector('#id' + id);
    var balance = document.querySelector(".lesson_info .balance");

    switch (res.type) {
      case 1:
        {
          fresh_buttons("success");
          balance.innerHTML = Number(balance.innerHTML) - Number(balance.title);
          calendar_item.className = "lesson_item background_calendar_success";
          break;
        }

      case 2:
        {
          fresh_buttons("closed");
          calendar_item.className = "lesson_item background_calendar_closed";
          break;
        }

      case 3:
        {
          fresh_buttons("normal");
          balance.innerHTML = Number(balance.innerHTML) + Number(balance.title);
          calendar_item.className = "lesson_item background_calendar_transfer";
          break;
        }
    }
  };

  PostForm(form, func);
};

var fresh_buttons = function fresh_buttons(news) {
  var button_fool = document.querySelectorAll(".lesson_info .button");

  if (news === "transfer") {
    news = "normal";
  }

  var button_new = document.querySelectorAll(".lesson_info .".concat(news));
  button_fool.forEach(function (item) {
    item.classList.add('no_display');
  });
  button_new.forEach(function (item) {
    item.classList.remove('no_display');
  });
};

var change_menu_right = function change_menu_right() {
  var right_menu_active;
  var menu_right_fool = document.querySelectorAll(".menu_item");

  switch (localStorage.getItem("menu_right")) {
    case "1":
      right_menu_active = document.querySelectorAll(".content_info");
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

    case "5":
      right_menu_active = document.querySelectorAll(".payed_naw");
      break;

    default:
      console.warn("no active " + localStorage.getItem("menu_right"));
      return false;
  }

  if (right_menu_active[0].classList.contains('content_info') && !right_menu_active[0].classList.contains('no_display')) {
    _toConsumableArray(menu_right_fool).forEach(function (item) {
      item.classList.add("no_display");
    });

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
  var url = url_info;
  var lesson_infos = document.querySelector('.lesson_info');
  lesson_infos.classList.add('progress_reload');

  var func = function func(response) {
    fresh_buttons(e.className.replace(/lesson_item background_calendar_/g, ""));
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
    'id': e.id.replace(/id/, "")
  };
  Post(url, func, parameters);
};

old_transaction_active = undefined;

window.transaction_info_open = function (from) {
  function change_modal(modal_name) {
    var id = transaction_info.querySelector(".".concat(modal_name));
    id.innerHTML = from.querySelector(".".concat(modal_name)).innerHTML;
    console.log(from);
  }

  from.classList.add("active");

  if (old_transaction_active !== from && old_transaction_active) {
    old_transaction_active.classList.remove("active");
  }

  old_transaction_active = from;
  var transaction_info = document.querySelector('.transaction_info');
  target_menu_right(4);
  change_modal("id");
  change_modal("student_name");
  change_modal("type");
  change_modal("status");
  change_modal("balance");
  change_modal("amount");

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