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
        <input type="text" name="fullname" id="fullname" class="form-control">
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
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
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
      </div>
    </div>
    <?php
      # MÉTODO NO ESTÁTICO
      // $register = new formController;
      // $register->userRegister();
    ?>
    <?php
      # MÉTODO ESTÁTICO
        $register = formController::userRegister();
        if ($register == 'ok'):
    ?>
      <script type="text/javascript">
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>
      <div class="alert alert-success">Registro Exitoso</div>
    <?php endif ?>
    <?php
      # MÉTODO ESTÁTICO
        if ($register == 'error'):
    ?>
      <script type="text/javascript">
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>
      <div class="alert alert-danger">Valide los datos proporcionados.</div>
    <?php endif ?>
    <button type="submit" class="btn btn-block btn-primary">Ingresar</button>
  </form>
</div>