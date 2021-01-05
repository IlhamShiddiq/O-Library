const check_buku = document.querySelector('#check-buku')
const check_ebook = document.querySelector('#check-ebook')
const check_member = document.querySelector('#check-member')
const check_librarian = document.querySelector('#check-librarian')
const check_publisher = document.querySelector('#check-publisher')
const check_category = document.querySelector('#check-category')
const check_report = document.querySelector('#check-report')

check_buku.addEventListener('click', () => {
    const wrapper_buku = document.querySelector('#wrapper-buku')
    if (check_buku.checked == true){
        wrapper_buku.classList.remove('checkbox-wrapper-unchecked')
        wrapper_buku.classList.add('checkbox-wrapper-checked')
    } else {
        wrapper_buku.classList.remove('checkbox-wrapper-checked')
        wrapper_buku.classList.add('checkbox-wrapper-unchecked')
    }
})

check_ebook.addEventListener('click', () => {
    const wrapper_ebook = document.querySelector('#wrapper-ebook')
    if (check_ebook.checked == true){
        wrapper_ebook.classList.remove('checkbox-wrapper-unchecked')
        wrapper_ebook.classList.add('checkbox-wrapper-checked')
    } else {
        wrapper_ebook.classList.remove('checkbox-wrapper-checked')
        wrapper_ebook.classList.add('checkbox-wrapper-unchecked')
    }
})

check_member.addEventListener('click', () => {
    const wrapper_member = document.querySelector('#wrapper-member')
    if (check_member.checked == true){
        wrapper_member.classList.remove('checkbox-wrapper-unchecked')
        wrapper_member.classList.add('checkbox-wrapper-checked')
    } else {
        wrapper_member.classList.remove('checkbox-wrapper-checked')
        wrapper_member.classList.add('checkbox-wrapper-unchecked')
    }
})

check_librarian.addEventListener('click', () => {
    const wrapper_librarian = document.querySelector('#wrapper-librarian')
    if (check_librarian.checked == true){
        wrapper_librarian.classList.remove('checkbox-wrapper-unchecked')
        wrapper_librarian.classList.add('checkbox-wrapper-checked')
    } else {
        wrapper_librarian.classList.remove('checkbox-wrapper-checked')
        wrapper_librarian.classList.add('checkbox-wrapper-unchecked')
    }
})

check_publisher.addEventListener('click', () => {
    const wrapper_publisher = document.querySelector('#wrapper-publisher')
    if (check_publisher.checked == true){
        wrapper_publisher.classList.remove('checkbox-wrapper-unchecked')
        wrapper_publisher.classList.add('checkbox-wrapper-checked')
    } else {
        wrapper_publisher.classList.remove('checkbox-wrapper-checked')
        wrapper_publisher.classList.add('checkbox-wrapper-unchecked')
    }
})

check_category.addEventListener('click', () => {
    const wrapper_category = document.querySelector('#wrapper-category')
    if (check_category.checked == true){
        wrapper_category.classList.remove('checkbox-wrapper-unchecked')
        wrapper_category.classList.add('checkbox-wrapper-checked')
    } else {
        wrapper_category.classList.remove('checkbox-wrapper-checked')
        wrapper_category.classList.add('checkbox-wrapper-unchecked')
    }
})

check_report.addEventListener('click', () => {
    const wrapper_report = document.querySelector('#wrapper-report')
    if (check_report.checked == true){
        wrapper_report.classList.remove('checkbox-wrapper-unchecked')
        wrapper_report.classList.add('checkbox-wrapper-checked')
    } else {
        wrapper_report.classList.remove('checkbox-wrapper-checked')
        wrapper_report.classList.add('checkbox-wrapper-unchecked')
    }
})