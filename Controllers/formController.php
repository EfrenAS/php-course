<?php

class formController {

  /**
   * @method: userRegister
   * description: Metodo para registrar un nuevo usuario
   * @param; none
   * @return: array
   */
  static function userRegister() {
    if (isset($_POST['fullname'])) {
      # MÉTODO NO ESTÁTICO MUESTRA LA INFORMACIÓN DESDE EL CONTROLADOR EN LA VISTA
      // echo $_POST['name'];

      # MÉTODO ESTÁTICO RETORNA LA INFORMACIÓN A LA VISTA

      /*** ==> Protección contra ataques XSS (Cross-Site Scripting) <== ***/
      if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['fullname']) &&
          preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $_POST['email']) &&
          preg_match('/^[0-9a-zA-Z.-_]+$/', $_POST['password'])
         ) {
        $table = 'records';
        /*** ==> Proteccion contra ataques CSFR (Cross-Site Request Forgeries) <== ***/
        $token = md5($_POST['fullname'] . '+' . $_POST['email']);
        /*** ==> Contraseña encriptada <== ***/
        $encryptedPassword = crypt($_POST['password'], '$2a$07$mastersenphp7poomvcmysql$');
        $data = array('token' => $token,
                      'fullname' => $_POST['fullname'],
                      'email' => $_POST['email'],
                      'password' => $encryptedPassword
                    );
        $respond = Forms::create($table, $data);
        return $respond;
      } else {
        $respond = 'error';
        return $respond;
      }
    }
  }

  /**
   * @method: selectRecords
   * description: Seleccionar regitrios
   * @param: $item, $value
   * @return: array
   */
  static public function selectRecords($item, $value) {
    $table = "records";

    $respond = Forms::read($table, $item, $value);
    return $respond;
  }

  /**
   * @method: login
   * description: loguearse en la app
   * @param: none
   * @return: array
   */
  public function login() {
    if(isset($_POST['email'])) {
      $table = 'records';
      $item = 'email';
      $value = $_POST['email'];
      $respond = Forms::read($table, $item, $value);
      $encryptedPassword = crypt($_POST['password'], '$2a$07$mastersenphp7poomvcmysql$');
      if($respond['email'] == $_POST['email'] && $respond['password'] == $encryptedPassword) {
        Forms::updateAttempts($table, 0, $respond['token']);
        $_SESSION['loginCorrect'] ='ok';
        echo '<script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
        window.location = "home";
      </script>';
      } else {
        if ($respond['failed_attempts'] < 3) {
          $failedAttempts = $respond['failed_attempts'] + 1;
          Forms::updateAttempts($table, $failedAttempts, $respond['token']);
        } else {
          echo "<div class='alert alert-warning'>RECAPTCHA Debes validar que no eres un robot.</div>";
        }
          echo '<script>
            if (window.history.replaceState) {
              window.history.replaceState(null, null, window.location.href);
            }
          </script>';
          echo "<div class='alert alert-danger'>Email o contraseña incorrecta. Intenta nuevamente.</div>";
      }
    }
  }

  /**
   * @method: updateRecord
   * description: Actualizar un registro
   * @param: none
   * @return: String
   */
  static public function updateRecord() {
    if (isset($_POST['fullname'])) {
      if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['fullname']) &&
          preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $_POST['email'])) {
        $user = Forms::read('records', 'token', $_POST['token']);
        $tempToken = md5($user['fullname']. '+' . $user['email']);
        if ($tempToken == $_POST['token']) {
          if ($_POST['password'] != '') {
            if (preg_match('/^[0-9a-zA-Z.-_]+$/', $_POST['password'])) {
              $password = crypt($_POST['password'], '$2a$07$mastersenphp7poomvcmysql$');
            }
          } else {
            $password = $_POST['oldPassword'];
          }
          $table = 'records';
          $data = array('token' => $_POST['token'],
                        'fullname' => $_POST['fullname'],
                        'email' => $_POST['email'],
                        'password' => $password);
          $respond = Forms::update($table, $data);
          return $respond;
        } else {
          $respond = 'error';
          return $respond;
        }
      } else {
        $respond = 'error';
        return $respond;
      }
    }
  }

  /**
   * @method: deleteRecord
   * description: Eliminar registro
   * @param: none
   * @return: String
   */
  public function deleteRecord() {
    if (isset($_POST['token'])) {
      $user = Forms::read('records', 'token', $_POST['token']);
      $tempToken = md5($user['fullname']. '+' . $user['email']);
      if($tempToken == $_POST['token']) {
        $table = 'records';
        $value = $_POST['token'];
        $request = Forms::delete($table, $value);
        if ($request == 'ok') {
          echo '<script>
            if (window.history.replaceState) {
              window.history.replaceState(null, null, window.location.href);
            }
            window.location = "home";
          </script>';
        }
      }
    }
  }
}
