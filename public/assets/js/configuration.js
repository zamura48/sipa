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

function displayErrors(errors) {
    removeErrors();
    $.each(errors, function(field, messages) {
        var inputField = $('[name="' + field + '"]');
        inputField.addClass('is-invalid');
        inputField.after('<div class="invalid-feedback">' + messages.join('<br>') + '</div>');
    });
}

function removeErrors() {
    $('.invalid-feedback').remove();
    $('input, select, textarea').removeClass('is-invalid');
}
