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

<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0">
  <div class="container-fluid mt-2 mb-2">
    <div class="col-lg-12">
      <div class="col-md-1 float-left" style="display: flex;">

      </div>
      <div class="col-md-4 float-left text-white">
        <a href="index.php?page=home" style="color: #fff;">
          <large><img src="../assets/img/logo-atual-v4-white5.png" class="logo-head"></large>
        </a>
      </div>
      <div class="float-right">
        <div class=" dropdown mr-4">
          <a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_resp_nome'] ?> </a>
          <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -5.4em;">
            <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Gerenciar conta</a>
            <a class="dropdown-item" href="../admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Sair</a>
          </div>
        </div>
      </div>
    </div>

</nav>

<script>
  $('#manage_my_account').click(function() {
    uni_modal("Gerenciar Conta", "manage_responsavel.php?id=<?php echo $_SESSION['login_resp_id'] ?>&mtype=own")
  })
</script>