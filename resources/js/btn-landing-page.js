import $ from 'jquery';

const btn = document.getElementById('up-btn');
const more = document.getElementById('show-more');
const less = document.getElementById('show-less');

window.addEventListener('scroll', () => {
    const vertical = window.scrollY;

    if (vertical > 400) {
        btn.classList.add('show-btn');
        btn.classList.remove('hide-btn');
    } else {
        btn.classList.remove('show-btn');
        btn.classList.add('hide-btn');
    }
});

btn.addEventListener('click', () => {
    $('html, body').animate({ scrollTop: 0 }, 800);
});

more.addEventListener('click', () => {
    more.classList.add('d-none');
    less.classList.remove('d-none');
});

less.addEventListener('click', () => {
    less.classList.add('d-none');
    more.classList.remove('d-none');
});
