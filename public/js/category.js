/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/category.js ***!
  \**********************************/
//
var handles = document.getElementsByClassName('edit-handle');
var wrappers = document.getElementsByClassName('edit-wrapper');
var closeHandles = document.getElementsByClassName('close-edit-form-handle');
var list = document.getElementById('category-list');
var _loop = function _loop(i) {
  handles[i].addEventListener('click', function () {
    closeWrappers();
    list.classList.add('blue');
    wrappers[i].classList.remove('d-none');
  });
  closeHandles[i].addEventListener('click', function () {
    list.classList.remove('blue');
    wrappers[i].classList.add('d-none');
  });
};
for (var i = 0; i < handles.length; i++) {
  _loop(i);
}
function closeWrappers() {
  for (var _i = 0; _i < wrappers.length; _i++) {
    wrappers[_i].classList.add('d-none');
  }
}
var url = window.location.href;
var parts = url.split("#");
if (parts.length != 1) {
  var id = parts[1];
  var value = parts[2];
  if (id != 0) {
    for (var _i2 = 0; _i2 < wrappers.length; _i2++) {
      if (wrappers[_i2].dataset.id == id) {
        handles[_i2].click();
        wrappers[_i2].querySelector('input.input-name').value = value.replace(/%20/g, ' ');
        ;
      }
    }
  }
}
/******/ })()
;