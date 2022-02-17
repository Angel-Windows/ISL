/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/menu_right.js ***!
  \************************************/
window.change_status_filter = function (item) {
  console.log(item);
};

window.calendar_filter = function (url, id, elem) {
  elem.querySelector('.img').classList.toggle('check');

  var func = function func(e) {
    console.log(e);
  };

  var parameters = {
    'id': id
  };
  Post(url, func, parameters);
};
/******/ })()
;
