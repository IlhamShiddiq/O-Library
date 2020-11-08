const btn = document.querySelector('#btn-close-message');
const msg = document.querySelector('.message');

btn.addEventListener('click', () => {
    msg.classList.add('hide-msg');
});