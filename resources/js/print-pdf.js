const load = document.querySelector('#load');
$(document).on('click','#print-card',() => {

    load.classList.remove('d-none');
    load.classList.add('d-inline-block');
    
}); 