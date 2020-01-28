<div class="d-flex justify-content-center text-center">
  <form class="p-5 bg-light" method="post">
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
      <label for="password">Contraseña</label>
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
        $register = new formController;
        $register->login();
    ?>
    <button type="submit" class="btn btn-block btn-primary">Login</button>
  </form>
</div>