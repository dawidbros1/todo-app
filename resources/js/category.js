//
var handles = document.getElementsByClassName('edit-handle');
var wrappers = document.getElementsByClassName('edit-wrapper');
var closeHandles = document.getElementsByClassName('close-edit-form-handle')
var list = document.getElementById('category-list');

for (let i = 0; i < handles.length; i++) {
   handles[i].addEventListener('click', () => {
      closeWrappers();
      list.classList.add('blue')
      wrappers[i].classList.remove('d-none');
   })

   closeHandles[i].addEventListener('click', () => {
      list.classList.remove('blue')
      wrappers[i].classList.add('d-none')
   })
}

function closeWrappers() {
   for (let i = 0; i < wrappers.length; i++) {
      wrappers[i].classList.add('d-none');
   }
}

const url = window.location.href;
const parts = url.split("#");

if (parts.length != 1) {
   const id = parts[1]
   const value = parts[2]

   if (id != 0) {
      for (let i = 0; i < wrappers.length; i++) {
         if (wrappers[i].dataset.id == id) {
            handles[i].click();
            wrappers[i].querySelector('input.input-name').value = value.replace(/%20/g, ' ');;
         }
      }
   }
}


