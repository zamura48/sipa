$(document).ready(function() {
    /* Ajax Token */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
});

function notif_success(message = '') {
    Toast.fire({
        icon: "success",
        title: "Berhasil! " + message
    });
}

function notif_error(message = '') {
    Toast.fire({
        icon: "error",
        title: "Terjadi Kesalahan! " + message
    });
}
