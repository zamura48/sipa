$(document).ready(function() {

    /* Ajax Token */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.js-select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    $('.js-currency').on('input', function() {
        var input_val = $(this).val();
        $(this).val('Rp'+format_currency(input_val));
    });

    $(".js-datepicker").datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "auto",
        todayHighlight: true
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
        title: message
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

function format_currency(value) {
    value = value.replace(/[^0-9]/g, '');
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    return value;
}
