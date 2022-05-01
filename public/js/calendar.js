/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/calendar.js ***!
  \**********************************/
window.calendar_fill = function (data, data_status) {
  data.forEach(function (item) {
    console.log(data_status);
    calendar_item_fill(item, data_status);
  });
};

window.calendar_item_fill = function (item, data_status) {
  var array_elem = [0, 1, 2, 3, 4, 5, 6, 0];
  var time = item.time_start.split(":");
  var fool_time = item.fool_time.split("-");
  var calendar_item = document.querySelector(".d".concat(fool_time[1], "-").concat(fool_time[2], ".t").concat(time[0]));
  var calendar_ = document.querySelector('#calendar_');
  var calendar_new = calendar_.cloneNode(true);

  if (data_status[item.status].display) {
    calendar_new.classList.remove('no_display');
  }

  calendar_new.id = "calendar_" + item['id'];
  calendar_new.id = "calendar_" + item['id'];
  calendar_new.querySelector("input[name=\"id\"]").value = item['id'];
  calendar_new.querySelector(".student_name").innerHTML = item['first_name'] + " " + item['last_name'];
  calendar_new.querySelector(".time_lesson").innerHTML = "".concat(time[0], ":00 - ").concat(Number(time[0]) + 1, ":00");
  calendar_new.querySelector(".time_lesson").innerHTML = item['fool_time'];

  if (data_status.length) {
    calendar_new.classList.add(data_status[item.status]["class"]);
  } else {
    calendar_new.classList.add("background_calendar_normal");
  }

  calendar_item.appendChild(calendar_new);
};
/******/ })()
;