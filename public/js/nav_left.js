/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/nav_left.js ***!
  \**********************************/
var root = document.documentElement;
var temp_theme = 0;

window.changeTheme = function () {
  if (temp_theme) {
    root.style.setProperty('--color_light_grey', "#474747");
    root.style.setProperty('--color_dark_grey', "#272727");
    root.style.setProperty('--color_dark_grey-2', "#3C3C3C");
    temp_theme = 0;
  } else {
    root.style.setProperty('--color_light_grey', "red");
    root.style.setProperty('--color_dark_grey', "green");
    root.style.setProperty('--color_dark_grey-2', "darkgreen");
    temp_theme = 1;
  }
}; // root.style.setProperty('--color_light_grey', "red");
// root.style.setProperty('--mouse-y', e.clientY + "px");
/******/ })()
;