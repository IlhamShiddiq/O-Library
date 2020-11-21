const row = document.querySelector('#row-buku-dua');
const satu = document.querySelector('#satuBuku');
const dua = document.querySelector('#duaBuku');

dua.addEventListener("click", event => {
    row.classList.remove("d-none");
});

satu.addEventListener("click", event => {
    row.classList.toggle("d-none");
});
