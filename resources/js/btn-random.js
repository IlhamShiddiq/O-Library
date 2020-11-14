const random = document.querySelector("#btn-random");
const kodeInput = document.querySelector("#kodeKonfirmasi");



random.addEventListener("click", event => {
    let result           = '';
    const characters       = '123456789';
    const charactersLength = characters.length;
    for ( let i = 0; i < 6; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }

    kodeInput.value = result;
})
