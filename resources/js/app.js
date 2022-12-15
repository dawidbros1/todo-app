require('./bootstrap');

window.onload = function () {
   var closeButton = document.getElementById('close');

   if (closeButton != null) {
      closeButton.addEventListener('click', () => {
         document.getElementById('message').classList.add('d-none');
      })
   }
}
