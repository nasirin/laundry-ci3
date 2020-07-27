const login = $('.login').data('login');

if (login) {
    swal.fire({
        title: 'Error',
        text: login,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}