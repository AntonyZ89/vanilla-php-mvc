"use strict";

const footerHeight = document.querySelector('footer').offsetHeight || 0;
const mainNavbarHeight = document.querySelector('#main-navbar').offsetHeight || 0;
const windowHeight = window.innerHeight;
const containerHeight = windowHeight - footerHeight - mainNavbarHeight;

document
    .querySelectorAll('body:not(.login) > main > .container, main > .container-fluid')
    .forEach((e) => {
        e.style.minHeight = containerHeight + 'px';
    });

document.querySelectorAll('.alert .btn-close')
    .forEach((e) => {
        e.addEventListener('click', function (e) {
            e.target.parentElement.remove()
        });
    });


document.querySelectorAll('a[data-method]')
    .forEach((e) => {
        e.addEventListener('click', function (e) {
            e.preventDefault();

            const target = e.target;
            const url = target.href;

            fetch(url, {
                method: target.dataset.method,
                redirect: 'follow'
            })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    }
                });
        });
    });