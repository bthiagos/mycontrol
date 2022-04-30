/**
    * @description      : 
    * @author           : edem
    * @group            : 
    * @created          : 17/09/2021 - 17:21:03
    * 
    * MODIFICATION LOG
    * - Version         : 1.0.0
    * - Date            : 17/09/2021
    * - Author          : edem
    * - Modification    : 
**/
new WOW().init();

$(window).scroll(function () {


  var topWindow = $(window).scrollTop();
  var topWindow = topWindow * 1.5;
  var windowHeight = $(window).height();
  var position = topWindow / windowHeight;
  position = 1 - position;

  $('#bottom').css('opacity', position);

});

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.display = "0";
  document.body.style.backgroundColor = "white";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginRight = "0";
  document.body.style.backgroundColor = "white";
}


$(window).on("scroll", function () {
  if ($(this).scrollTop() > 10) {
    $("nav.navbar").addClass("mybg-dark");
    $("nav.navbar").addClass("navbar-shrink");


  } else {
    $("nav.navbar").removeClass("mybg-dark");
    $("nav.navbar").removeClass("navbar-shrink");

  }



});

$(function () {
  $('#bottom').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
    }
  });
});
$(document).ready(function () {
  $(".fancybox").fancybox({
    openEffect: "none",
    closeEffect: "none"
  });
});

$('#login-form').submit(function (e) {
  e.preventDefault()
  $('#login-form button[type="button"]').attr('disabled', true).html('Acessando...');
  if ($(this).find('.alert-danger').length > 0)
    $(this).find('.alert-danger').remove();
  $('#msg').html('')
  $.ajax({
    url: 'admin/ajax.php?action=login2',
    method: 'POST',
    data: $(this).serialize(),
    error: err => {
      console.log(err)
      $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

    },
    success: function (resp) {
      if (resp == 1) {
        $('#login-form').prepend(
          Swal.fire({
            title: 'Aguarde',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
          }).then(function () {
            window.location = "painel/index.php?page=home";
          })
        )
      } else if (resp == 2) {
        $('#login-form').prepend(
          Swal.fire({
            icon: 'warning',
            title: 'Ative seu e-mail!',
            text: 'Para acessar o sistema, você precisa ativar o seu e-mail.',
          })
        )
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
      } else {
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
});

$('#signup-frm').submit(function (e) {
  e.preventDefault()
  $('#signup-frm button[type="submit"]').attr('disabled', true).html('Salvando...');
  if ($(this).find('.alert-danger').length > 0)
    $(this).find('.alert-danger').remove();
  $.ajax({
    url: 'admin/ajax.php?action=signup',
    method: 'POST',
    data: $(this).serialize(),
    error: err => {
      console.log(err)
      $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
    },
    
    success: function (resp) {
      if (resp == 1) {
        $('#signup-frm').prepend(
          Swal.fire({
            icon: 'success',
            title: 'Cadastro realizado com sucesso!',
            text: 'Ative seu e-mail para entrar no sistema.'
          })
        )
        setTimeout(function () {
          location.reload()
        }, 3000)
      }
      else if (resp == 2) {
        $('#signup-frm').prepend(
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'E-mail ou CPF já cadastrado!',
          })
        )
      }
      else if (resp == 3) {
        $('#signup-frm').prepend(
          Swal.fire({
            icon: 'error',
            title: 'Eita!',
            text: 'Seus dados estão errados, tente novamente...',
          })
        )
      } else if (resp == 4) {
        $('#signup-frm').prepend(
          Swal.fire({
            icon: 'warning',
            title: 'Opa!',
            text: 'O E-mail não foi enviado!!!',
          })
        )
      } 
      else if (resp == 5) {
        $('#signup-frm').prepend(
          Swal.fire({
            icon: 'warning',
            title: 'Opa!',
            text: 'CPF Inválido! Digite um CPF válido.',
          })
        )
      }else {
        $('#signup-frm').prepend(
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Digite os dados válidos!',
          })
        )
      }
    }
  })
});


$('#esquecisenhaform').submit(function (e) {
  e.preventDefault()
  $('#esquecisenhaform button[type="submit"]').attr('disabled', true).html('Salvando...');
  if ($(this).find('.alert-danger').length > 0)
    $(this).find('.alert-danger').remove();
  $.ajax({
    url: 'admin/ajax.php?action=redefinir_senha',
    method: 'POST',
    data: $(this).serialize(),
    error: err => {
      console.log(err)
      $('#esquecisenhaform button[type="submit"]').removeAttr('disabled').html('Create');

    },
    success: function (resp) {
      if (resp == 1) {
        $('#esquecisenhaform').prepend(
          Swal.fire({
            icon: 'success',
            title: 'E-mail enviado com sucesso!',
            text: 'Acesse seu e-mail para redefinir senha.'
          })
        )
        setTimeout(function () {
          location.reload()
        }, 3000)
      }
      else if (resp == 2) {
        $('#esquecisenhaform').prepend(
          Swal.fire({
            icon: 'error',
            title: 'Opa!',
            text: 'Este e-mail não existe no sistema, tente novamente...',
          })
        )
      } else if (resp == 3) {
        $('#esquecisenhaform').prepend(
          Swal.fire({
            icon: 'error',
            title: 'Opa!',
            text: 'Operação não realizada!',
          })
        )
      } else if (resp == 4) {
        $('#esquecisenhaform').prepend(
          Swal.fire({
            icon: 'warning',
            title: 'Opa!',
            text: 'O E-mail não foi enviado!!!',
          })
        )
      } else {
        $('#esquecisenhaform').prepend(
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Problema desconhecido...',
          })
        )
      }
    }
  })
});

$('#set_senhanova').submit(function (e) {
  e.preventDefault()
  $('#set_senhanova button[type="submit"]').attr('disabled', true).html('Salvando...');
  if ($(this).find('.alert-danger').length > 0)
    $(this).find('.alert-danger').remove();
  $.ajax({
    url: 'admin/ajax.php?action=set_nova_senha',
    method: 'POST',
    data: $(this).serialize(),
    error: err => {
      console.log(err)
      $('#set_senhanova button[type="submit"]').removeAttr('disabled').html('Create');

    },
    success: function (resp) {
      if (resp == 1) {
        $('#set_senhanova').prepend(
          Swal.fire({
            icon: 'success',
            title: 'Senha alterada com sucesso!',
            text: 'Acesso o sistema utilizando a nova senha.'
          })
        )
        setTimeout(function () {
          location.reload()
        }, 3000)
      }
      else if (resp == 2) {
        $('#set_senhanova').prepend(
          Swal.fire({
            icon: 'error',
            title: 'Opa!',
            text: 'As senhas não estão iguais...',
          })
        )
      } else {
        $('#set_senhanova').prepend(
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Algo deu errado!',
          })
        )
      }
    }
  })
});
/*
$('#login-form').submit(function(e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Acessando...');
    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();
    $('#msg').html('')
    $.ajax({
      url: 'admin/ajax.php?action=login2',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

      },
      success: function(resp) {
        if (resp == 1) {
          location.href = 'painel/index.php?page=home';
        } else {
          $('#login-form').prepend('<div class="alert alert-danger">Usuário ou senha inválido!</div>')
          $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
        }
      }
    })
  });

  $('#signup-frm').submit(function(e) {
    e.preventDefault()
    $('#signup-frm button[type="submit"]').attr('disabled', true).html('Salvando...');
    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();
    $.ajax({
      url: 'admin/ajax.php?action=signup2',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

      },
      success: function(resp) {
        if (resp == 1) {
          //location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'painel/index.php?page=home' ?>';
          $('#signup-frm').prepend('<div class="alert alert-sucess">Cadastro realizado com sucesso! Ative seu e-mail.</div>')
          //alert_toast("Cadastro realizado com sucesso!", 'success')
          setTimeout(function() {
            confirm("Ative seu e-mail para entrar no sistema!");
            location.reload()
          }, 2000)

        } else if (resp == 2) {
          $('#signup-frm').prepend('<div class="alert alert-danger">E-mail já cadastrado!</div>')
          $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
        } else if (resp == 3) {
          $('#signup-frm').prepend('<div class="alert alert-danger">Seus dados estão errados, tente novamente...</div>')
          $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
        } else {
          $('#signup-frm').prepend('<div class="alert alert-danger">Ossada, cria...</div>')
          $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
        }
      }
    })
  });*/

$("#btn-alerta").click(function () {
  Swal.fire("Exemplos Básicos");
});