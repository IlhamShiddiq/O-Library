const row = document.querySelector('#row-kelas');
const siswa = document.querySelector('#radioSiswa');
const guru = document.querySelector('#radioGuru');

siswa.addEventListener("click", event => {
    row.classList.remove("d-none");
    row.classList.toggle("d-inline");
});

guru.addEventListener("click", event => {
    row.classList.remove("d-inline");
    row.classList.toggle("d-none");
});
