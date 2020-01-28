<?php
if (isset($_GET['token'])) {
  $item = 'token';
  $value = $_GET['token'];
  $user = formController::selectRecords($item, $value);
}
?>

<div class="d-flex justify-content-center text-center">
  <form class="p-5 bg-light" method="post">
    <div class="form-group">
      <label for="fullname">Nombre</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-user"></i>
          </span>
        </div>
        <input type="text" value="<?php echo $user['fullname']; ?>" name="fullname" id="fullname" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-envelope"></i>
          </span>
        </div>
        <input type="email" value="<?php echo $user['email']; ?>" class="form-control" name="email" id="email" aria-describedby="emailHelp">
      </div>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-key"></i>
          </span>
        </div>
        <input type="password" class="form-control" id="password" name="password">
        <input type="hidden" value="<?php echo $user['token']; ?>" id="token" name="token">
        <input type="hidden" value="<?php echo $user['password']; ?>" id="oldPassword" name="oldPassword">
      </div>
    </div>
    <?php
      $respond = formController::updateRecord();
      if ($respond == 'ok'):
    ?>
      <div class="alert alert-success">El usuario ha sido actualizado correctamente.</div>
      <script>
        if(window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
        setTimeout( function() {
            window.location = "index.php?url=home";
          }, 3000);
      </script>
    <?php
      endif
    ?>
    <?php
      if ($respond == 'error' ):
    ?>
      <script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>
      <div class="alert alert-danger">Error en proceso. No se actualizo el usuario.</div>
    <?php
      endif
    ?>
    <button type="submit" class="btn btn-block btn-warning">Actualizar</button>
  </form>
</div>