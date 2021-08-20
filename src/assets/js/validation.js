"use strict";

document.querySelectorAll('.document').forEach((el) => {
    el.addEventListener('keyup', (e) => {
        e.target.value = e.target.value.replace(/\D/g, '');
        console.log(e.target.value);
    })
});