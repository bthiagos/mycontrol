/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Cadastro');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function loginAjax(){
    /*   Remove this comments when moving to server
    $.post( "/login", function( data ) {
            if(data == 1){
                window.location.replace("/home");            
            } else {
                 shakeModal(); 
            }
        });
    */

/*   Simulate error message from the server   */
     shakeModal();
}


function shakeModal(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("E-mail ou senha inválidos!");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

$('#login-form').submit(function(e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Acessando...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: 'ajax.php?action=login2',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
            console.log(err)
            $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

        },
        success: function(resp) {
            if (resp == 1) {
                location.href = 'index.php?page=home';
            } else {
                $('#login-form').prepend('<div class="alert alert-danger">Usuário ou senha inválido!</div>')
                $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
            }
        }
    })
});

$('#signup-frm').submit(function(e){
    e.preventDefault()
    $('#signup-frm button[type="submit"]').attr('disabled',true).html('Salvando...');
    if($(this).find('.alert-danger').length > 0 )
        $(this).find('.alert-danger').remove();
    $.ajax({
        url:'admin/ajax.php?action=signup',
        method:'POST',
        data:$(this).serialize(),
        error:err=>{
            console.log(err)
    $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

        },
        success:function(resp){
            if(resp == 1){
                location.href ="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>";
            }else{
                $('#signup-frm').prepend('<div class="alert alert-danger">O e-mail já existe</div>')
                $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
            }
        }
    })
});