const alert = $('.success').data('success');
const alert2 = $('.error').data('error');
if (alert) {
    swal.fire({
        title: 'Success',
        text: alert,
        icon: 'success',
        confirmButtonText: 'OK'
    });
}else if(alert2){
    swal.fire({
      title: 'Error',
      text: alert2,
      icon: 'error',
      confirmButtonText: 'OK'
  });
}



// if (alert) {
//     swal.fire({
//         title: 'Error',
//         text: alert2,
//         icon: 'error',
//         confirmButtonText: 'OK'
//     });
// }

// tombol hapus
$('.tombol-hapus').on('click', function (e){
    e.preventDefault();
    const href = $(this).attr('href');
    swal.fire({
        title: 'Apakah anda yakin?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.value) {
        //   swal.fire(
        //     'Terhapus!',
        //     'Data berhasil dihapus',
        //     'success'
        //   )
          document.location.href = href;
        }
      })
});

// tombol keluar
$('.tombol-keluar').on('click', function (e){
  e.preventDefault();
  const href = $(this).attr('href');
  swal.fire({
      title: 'Exit',
      text: "Are you sure?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Logout'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    })
});