$(document).ready(function () {

    // For Kata Imbuhan
    // Tambah Kata Imbuhan
    var field_kata_imbuhan = $('[name= "kata_imbuhan"]');
    var field_kata_dasar = $('[name="kata_dasar"]');
    var btnTambahKataImbuhan = $('#btnTambahKataImbuhan');
    field_kata_dasar.attr('readdonly', 'true');
    btnTambahKataImbuhan.attr('disabled', true);

    if (field_kata_imbuhan.keyup(function () {
        if (field_kata_imbuhan.val() != '') {
            // Jika kolom Kata Imbuhan tidak Kosong
            btnTambahKataImbuhan.removeAttr("disabled");
            btnTambahKataImbuhan.attr("disabled", true);
            field_kata_dasar.attr('readonly', false);
        } else {
            // Jika kolom Kata Imbuhan Kosong
            field_kata_dasar.attr('readonly', true);
            btnTambahKataImbuhan.attr("disabled", true);
        }
    }));
    if (field_kata_dasar.keyup(function () {
        if (field_kata_dasar.val() != '') {
            btnTambahKataImbuhan.removeAttr("disabled");
            btnTambahKataImbuhan.click(function () {
                Swal.fire({
                    title: 'Tambah Kata Imbuhan?',
                    text: "Apakah Anda ingin menambahkan kata imbuhan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!',
                    cancelButtonText: 'Batalkan',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#formKataImbuhan').submit();
                    }
                })
            });
        } else {
            btnTambahKataImbuhan.attr("disabled", true);
        }
    }));


    // Check Kata Imbuhan
    kataImbuhan = $('[name="kata_imbuhan]').val();
    kataDasar = $('[name="kata_dasar"]').val();
    gabunganKata = $(kataImbuhan, kataDasar);
    $.ajax({
        url: "checkKataImbuhan",
        method: "POST",
        data: {
            kataImbuhan: kata_imbuhan,
            kataDasar: kata_dasar
        },
        success: function (response) {
            $('#alertKataImbuhan').html(response);
        }
    });



    // Alert Success jika Kata Imbuhan berhasil ditambahkan
    const successKataImbuhan = $('.kata-imbuhan').data('flashdata');
    if (successKataImbuhan) {
        Swal.fire(
            'Berhasil',
            'Kata Imbuhan berhasil ditambahkan',
            'success'
        );
    }




});