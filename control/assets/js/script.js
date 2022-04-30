window.start_load = function () {
    $('body').prepend('<di id="preloader2"></di>')
}
window.end_load = function () {
    $('#preloader2').fadeOut('fast', function () {
        $(this).remove();
    })
}
window.viewer_modal = function ($src = '') {
    start_load()
    var t = $src.split('.')
    t = t[1]
    if (t == 'mp4') {
        var view = $("<video src='" + $src + "' controls autoplay></video>")
    } else {
        var view = $("<img src='" + $src + "' />")
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view)
    $('#viewer_modal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false,
        focus: true
    })
    end_load()

}

window.uni_modal = function ($title = '', $url = '', $size = "", $params = {}) {
    start_load()
    $.ajax({
        url: $url,
        method: 'POST',
        data: $params,
        error: err => {
            console.log()
            alert("Ocorreu um erro!")
        },
        success: function (resp) {
            if (resp) {
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                if ($size != '') {
                    $('#uni_modal .modal-dialog').addClass($size)
                } else {
                    $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-dialog-centered modal-md")
                }
                $('#uni_modal').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false,
                    focus: true
                })
                end_load()
            }
        }
    })
}

window._conf = function ($msg = '', $func = '', $params = []) {
    $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
    $('#confirm_modal .modal-body').html($msg)
    $('#confirm_modal').modal('show')
}
window.alert_toast = function ($msg = 'TEST', $bg = 'success') {
    $('#alert_toast').removeClass('bg-success')
    $('#alert_toast').removeClass('bg-danger')
    $('#alert_toast').removeClass('bg-info')
    $('#alert_toast').removeClass('bg-warning')

    if ($bg == 'success')
        $('#alert_toast').addClass('bg-success')
    if ($bg == 'danger')
        $('#alert_toast').addClass('bg-danger')
    if ($bg == 'info')
        $('#alert_toast').addClass('bg-info')
    if ($bg == 'warning')
        $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({
        delay: 3000
    }).toast('show');
}
$(document).ready(function () {
    $('#preloader').fadeOut('fast', function () {
        $(this).remove();
    })
})
$('.datetimepicker').datetimepicker({
    format: 'Y/m/d H:i',
    startDate: '+3d'
})
$('.select2').select2({
    placeholder: "Por favor selecione aqui",
    width: "100%"
})


$('.btn-log').click(function () {
    uni_modal("<large><b>Escaneie ou digite a matrícula do aluno</b></large>", 'registros.php', '', { type: $(this).attr('data-type'), log: $(this).attr('data-log') })
})