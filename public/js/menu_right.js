/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/menu_right.js ***!
  \************************************/
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

  var func = function func(response) {};

  var parameters = {
    'id': id
  };
  Post(url, func, parameters);
};
/******/ })()
;