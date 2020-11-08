const row = document.querySelector('#row-buku-dua');
const satu = document.querySelector('#satuBuku');
const dua = document.querySelector('#duaBuku');

dua.addEventListener("click", event => {
    row.classList.remove("d-none");
    row.classList.toggle("d-inline");
});

satu.addEventListener("click", event => {
    row.classList.remove("d-inline");
    row.classList.toggle("d-none");
});
