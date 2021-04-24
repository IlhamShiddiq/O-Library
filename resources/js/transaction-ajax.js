const _CSRF = $('meta[name="_token"]').attr('content');
const APP_URL = $('meta[name="_base_url"]').attr('content');

jQuery('#cekAnggota').click(function(e){

    jQuery('#namaMember').val("");
    jQuery('#namaMember').attr("placeholder", "Mohon Tunggu");
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _CSRF
        }
    });
    jQuery.ajax({
        url: `${APP_URL}/check-member`,
        method: 'post',
        data: {
            nomor_induk: jQuery('#nomorIndukMember').val()
        },
        success: function(result){
            jQuery('#namaMember').val(result);
        }
    });
});

$('#keterlambatanModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    const today = button.data('today')

    var modal = $(this)
    modal.find('.wrapper').html(`
                                <div class="text-center">
                                    <div class='load d-inline-block rounded-circle mr-1'></div>
                                    <div class='load d-inline-block rounded-circle'></div>
                                    <div class='load d-inline-block rounded-circle ml-1'></div>
                                </div>`)
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _CSRF
        }
    });
    jQuery.ajax({
        url: `${APP_URL}/late-transaction`,
        method: 'post',
        data: {},
        success: (result) => {
            datas = result.split('~')
            datas.splice(datas.length - 1)

            let array_datas = []
            while(datas.length > 0) {

                let new_array = datas.splice(0, 9)

                array_datas.push(new_array)
            }

            let content = '';
            array_datas.forEach((data) => {
                if(data[7] >= today) return
                if(data[8] == '' || data[8] == '0000-00-00 00:00:00') data[8] = 'belum pernah diperingatkan'
                content += `
                        <div class="card late-card text-white bg-danger full-width mb-2 shadow">
                            <div class="card-header user position-relative">
                                ${data[4]} (${data[3]}/${data[5]})
                                <a href="${APP_URL}/send-reminder/${data[0]}" class="btn btn-light btn-sm btn-email position-absolute"><i class="fas fa-envelope-open"></i></a>
                            </div>
                            <div class="card-body py-2">
                                <p class="card-text m-0">${data[6]}</p>
                                <small class="text-white">Tenggang waktu : ${data[1]} s/d ${data[7]}</small>
                            </div>
                            <small class="text-white mb-1" style="margin-left: 20px;">Terakhir diperingatkan pada :<i> ${data[8]}</i></small>
                        </div>
                        `
            })
            modal.find('.wrapper').html(content)
        }
    });
})

$('#detailDataModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget)
    const id = button.data('id')
    const nomor = button.data('nomor')
    let wrapper = '';

    const modal = $(this)
    modal.find('.wrapper').html(`
                                <div class="text-center">
                                    <div class='load d-inline-block rounded-circle mr-1'></div>
                                    <div class='load d-inline-block rounded-circle'></div>
                                    <div class='load d-inline-block rounded-circle ml-1'></div>
                                </div>`)
    modal.find('.detail-nama').html(`ID TRANSAKSI : ${id}`)
    modal.find('.detail-username').html(`NIS/NIP : ${nomor}`)
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _CSRF
        }
    });
    jQuery.ajax({
        url: `${APP_URL}/check-detail`,
        method: 'post',
        data: {
            id: id
        },
        success: function(result){
            let splits = result.split('~');
            splits.forEach((split) => {
                if(split == '') return;

                wrapper += `
                            <div class="row form-mg">
                                <div class="col-12">
                                    <div class="form-group">
                                        <small for="judulBukuPertamaDetail">Buku yang dipinjam</small>
                                        <input type="text" class="form-control" name="judulBukuPertamaDetail" value="${split}" readonly>
                                    </div>
                                </div>
                            </div>`;
            })
            modal.find('.wrapper').html(wrapper)
        }
    });
})

$('#editDataModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget)
    const id = button.data('id')
    let wrapper = '';

    const modal = $(this)
    modal.find('.modal-body').html(`
                                <form action="${APP_URL}/transaction/edit/${id}" method="POST">
                                    <input type="hidden" name="_token" value="${_CSRF}">
                                    <div class="wrapper"></div>
                                </form>`)

    modal.find('.wrapper').html(`
                                <div class="text-center">
                                    <div class='load d-inline-block rounded-circle mr-1'></div>
                                    <div class='load d-inline-block rounded-circle'></div>
                                    <div class='load d-inline-block rounded-circle ml-1'></div>
                                </div>`)
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _CSRF
        }
    });
    jQuery.ajax({
        url: `${APP_URL}/check-detail-edit`,
        method: 'post',
        data: {
            id: id
        },
        success: function(result){
            let splits = result.split('~');
            const count = splits[0];
            
            wrapper += `
                    <div class="row form-mg">
                        <div class="col-5 pr-1">
                            <div class="form-group">
                                <small for="idBukuPertamaEdit">ID Buku</small>
                                <input type="text" class="form-control" id="idBukuPertamaEdit" name="idBukuPertamaEdit" placeholder="Isikan disini..." value="${splits[1]}">
                            </div>
                        </div>
                        <div class="col-1 pl-1">
                            <button type="button" class="btn btn-primary mt-4 btn-sm-text px-2" id="cekBukuPertamaEdit"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="judulBukuPertamaEdit">Judul Buku</small>
                                <input type="text" class="form-control" id="judulBukuPertamaEdit" name="judulBukuPertamaEdit" placeholder="Isikan disini..." readonly value="${splits[2]}">
                            </div>
                        </div>
                    </div>`

            if(count == '2')
            {
                wrapper += `
                    <div class="row form-mg" id="row-buku-dua-detail">
                        <div class="col-5 pr-1">
                            <div class="form-group">
                                <small for="idBukuKeduaEdit">ID Buku kedua</small>
                                <input type="text" class="form-control" id="idBukuKeduaEdit" name="idBukuKeduaEdit" placeholder="Isikan disini..." value="${splits[3]}">
                            </div>
                        </div>
                        <div class="col-1 pl-1">
                            <button type="button" class="btn btn-primary mt-4 btn-sm-text px-2" id="cekBukuKeduaEdit"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="judulBukuKeduaEdit" >Judul Buku Kedua</small>
                                <input type="text" class="form-control" id="judulBukuKeduaEdit" name="judulBukuKeduaEdit" placeholder="Isikan disini..." readonly value="${splits[4]}">
                            </div>
                        </div>
                    </div>`
            }

            wrapper += `
                    <div class="row justify-content-center">
                        <div class="col-12 text-center px-1 btn-wrapper">
                            <button type="submit" class="btn btn-sm btn-success px-4">Edit Data</button>
                        </div>
                    </div>`

            modal.find('.wrapper').html(wrapper)

            
            jQuery('#cekBukuPertamaEdit').click(function(e){
                jQuery('#judulBukuPertamaEdit').val("");
                jQuery('#judulBukuPertamaEdit').attr("placeholder", "Mohon Tunggu...");
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _CSRF
                    }
                });
                jQuery.ajax({
                    url: `${APP_URL}/check-book`,
                    method: 'post',
                    data: {
                        id: jQuery('#idBukuPertamaEdit').val()
                    },
                    success: function(result){
                        jQuery('#judulBukuPertamaEdit').val(result);
                    }
                });
            });
            
            jQuery('#cekBukuKeduaEdit').click(function(e){
                jQuery('#judulBukuKeduaEdit').val("");
                jQuery('#judulBukuKeduaEdit').attr("placeholder", "Mohon Tunggu...");
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _CSRF
                    }
                });
                jQuery.ajax({
                    url: `${APP_URL}/check-book`,
                    method: 'post',
                    data: {
                        id: jQuery('#idBukuKeduaEdit').val()
                    },
                    success: function(result){
                        jQuery('#judulBukuKeduaEdit').val(result);
                    }
                });
            });
        }
    });
});