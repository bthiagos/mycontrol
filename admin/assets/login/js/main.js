$(function() {
	'use strict';
	
  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

});

$('#login-form').submit(function(e) {
	e.preventDefault()
	$('#login-form button[type="button"]').attr('disabled', true).html('Acessando...');
	if ($(this).find('.alert-danger').length > 0)
		$(this).find('.alert-danger').remove();
	$.ajax({
		url: 'ajax.php?action=login',
		method: 'POST',
		data: $(this).serialize(),
		error: err => {
			console.log(err)
			$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

		},
		success: function(resp) {
			if (resp == 1) {
				/* location.href = 'index.php?page=home'; */
				$('#login-form').prepend(
					Swal.fire({
						title: 'Aguarde',
						timer: 2000,
						timerProgressBar: true,
						showConfirmButton: false,
					}).then(function() {
						window.location = "index.php?page=home";
					})
				)
			} else if (resp == 2) {
				/* location.href = '../control/index.php'; */
				$('#login-form').prepend(
					Swal.fire({
						title: 'Aguarde',
						timer: 1000,
						timerProgressBar: true,
						showConfirmButton: false,
					}).then(function() {
						window.location = "../control/index.php";
					})
				)
			} else {
				/* $('#login-form').prepend('<div class="alert alert-danger">Usuário ou senha inválido!</div>') */
				$('#login-form').prepend(
					Swal.fire({
						icon: 'error',
						title: 'Ops!',
						text: 'Usuário ou senha inválido!',
					})
				)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
			}
		}
	})
})