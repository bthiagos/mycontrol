<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM alunos where id= " . $_GET['id']);
    foreach ($qry->fetch_array() as $k => $val) {
        $$k = $val;
    }
}
?>
<div class="container-fluid">
    <form action="" id="manage-student">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div id="msg" class="form-group"></div>
        <div class="form-group">
            <label for="" class="control-label">Matrícula</label>
            <input type="text" class="form-control" name="matricula" value="<?php echo isset($matricula) ? $matricula : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo isset($nome) ? $nome : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="" class="control-label">CPF</label>
            <input type="text" class="form-control" name="cpf" value="<?php echo isset($cpf) ? $cpf : '' ?>">
        </div>
        <div class="form-group">
            <label for="" class="control-label">E-mail</label>
            <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Foto</label>
            <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
        </div>
        <div class="form-group">
            <img src="<?php echo isset($img_path) ? './assets/uploads/' . $cover_img : '' ?>" alt="" id="cimg">
        </div>
    </form>
</div>
<style>
    img#cimg,
    .cimg {
        max-height: 10vh;
        max-width: 6vw;
    }
</style>
<script>
    $('#manage-student').on('reset', function() {
        $('#msg').html('')
        $('input:hidden').val('')
    })
    $('#manage-student').submit(function(e) {
        e.preventDefault()
        start_load()
        $('#msg').html('')
        $.ajax({
            url: 'ajax.php?action=save_student',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Dados salvos com sucesso.", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)
                } else if (resp == 2) {
                    $('#msg').html('<div class="alert alert-danger mx-2">Usuário já existe!</div>')
                    end_load()
                } else if (resp == 3) {
                    $('#msg').html('<div class="alert alert-danger mx-2">Não salvou por conta do Responsável</div>')
                    end_load()
                } else {
                    $('#msg').html('<div class="alert alert-danger mx-2">Erro desconhecido!!</div>')
                    end_load()
                }
            }
        })
    })

    $('.select2').select2({
        placeholder: "Selecione aqui",
        width: '100%'
    })
</script>