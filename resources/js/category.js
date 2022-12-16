//
var handles = document.getElementsByClassName('edit-handle');
var wrappers = document.getElementsByClassName('edit-wrapper');
var closeHandles = document.getElementsByClassName('close-edit-form-handle')
var list = document.getElementById('category-list');

for (let i = 0; i < handles.length; i++) {
    handles[i].addEventListener('click', () => {
        closeWrappers();
        list.classList.add('blur')
        wrappers[i].classList.remove('d-none');
    })

    closeHandles[i].addEventListener('click', () => {
        list.classList.remove('blur')
        wrappers[i].classList.add('d-none')
    })
}

function closeWrappers() {
    for (let i = 0; i < wrappers.length; i++) {
        wrappers[i].classList.add('d-none');
    }
}

