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
    list.classList.add('blur');
    wrappers[i].classList.remove('d-none');
  });
  closeHandles[i].addEventListener('click', function () {
    list.classList.remove('blur');
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
/******/ })()
;