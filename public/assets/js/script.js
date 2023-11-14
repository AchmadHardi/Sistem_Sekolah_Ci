$(Document).on('click', '#btn-edit', function () {

    $('.modal-body #nisn').val($(this).data('nisn'));
    $('.modal-body #nama').val($(this).data('nama'));
})

const swalMessage = $('.swal').data('swal');
if (swalMessage) {
    Swal.fire({
        title: 'Data Berhasil',
        text: swalMessage,
        icon: 'success'
    });
}
