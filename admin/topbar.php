<style>
  .logo-head {
    height: 20px;
    width: 120px;
  }

  .logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
  }
</style>

<nav class="navbar navbar-light fixed-top bg-dark" style="padding:0">
  <div class="container-fluid mt-2 mb-2">
    <div class="col-lg-12">
      <div class="col-md-1 float-left" style="display: flex;">
        <a href="index.php" style="color: #fff;">
          <img src="../assets/img/logo-atual-v4-white5.png" class="logo-head">
          <!-- <img src="<?php echo isset($_SESSION['system']['img_path']) ? './assets/uploads/' . $_SESSION['system']['img_path'] : $_SESSION['system']['nome'] ?>" class="logo-head"> -->
          <!-- <?php echo isset($row['img_path']) ? './assets/uploads/' . $row['img_path'] : '' ?> -->
        </a>
      </div>
      <div class="float-right">
        <div class=" dropdown mr-4">
          <a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_nome'] ?> </a>
          <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.9em;">
            <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account" data-id='<?php echo $_SESSION['login_id'] ?>'><i class="fa fa-cog"></i> Gerenciar conta</a>
            <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Sair</a>
          </div>
        </div>
      </div>
    </div>

</nav>

<script>
  $('#manage_my_account').click(function() {
    uni_modal('Gerenciar Conta', 'edit_user.php?id=' + $(this).attr('data-id'))
  })

  $('#new_user').click(function() {
    uni_modal('Novo Usuário', 'manage_user.php')
  })
  $('.edit_user').click(function() {
    uni_modal('Editar Usuário', 'manage_user.php?id=' + $(this).attr('data-id'))
  })
</script>