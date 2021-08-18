"use strict";

document.querySelectorAll('.alert .btn-close')
    .forEach((e) => {
        e.addEventListener('click', function (e) {
            e.target.parentElement.remove()
        });
    });