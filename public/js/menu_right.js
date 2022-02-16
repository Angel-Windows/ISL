/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/menu_right.js ***!
  \************************************/
window.change_status_filter = function (item) {
  console.log(item);
};

window.calendar_filter = function (form, id) {
  var url = form;
  console.log(document.head.getElementsByTagName('meta')[2]);
  ajax_post(url, {});
}; // const ajax_post = (url, data_attribute = {}) => {
//     if (!url) {
//         console.log("form is not defined");
//         // return 0;
//     }
//     const ajaxSend = async (formData) => {
//         const fetchResp = await fetch(url, {
//             method: 'POST',
//             body: formData
//         });
//         if (!fetchResp.ok) {
//             throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
//         }
//         return await fetchResp.text();
//     };
//     const formData = new FormData();
//     if (!is_empty_object(data_attribute)) {
//         for (let option_name in data_attribute) {
//             formData.append(option_name, data_attribute[option_name])
//         }
//     }
//     ajaxSend(formData)
//         .then((response) => {
//             console.log(response)
//         })
//         .catch((err) => console.error(err));
// }


var ajax_post = function ajax_post(url) {
  var data_attribute = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  fetch(url, {
    method: 'POST',
    headers: {// 'X-CSRF-TOKEN': ('meta[name="csrf-token"]').attr('content')
    },
    body: []
  }).then(function (response) {
    return "";
  })["catch"](function (error) {
    return console.error(error);
  });
};

function is_empty_object(obj) {
  for (var prop in obj) {
    if (obj.hasOwnProperty(prop)) return false;
  }

  return JSON.stringify(obj) === JSON.stringify({});
}
/******/ })()
;