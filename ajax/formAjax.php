<?php

require_once '../controllers/formController.php';
require_once '../models/forms.php';

class formAjax {

  public $tempEmail;

  public function validateEmail() {
    $item = 'email';
    $value = $this->tempEmail;
    $request = formController::selectRecords($item, $value);
    echo json_encode($request);
  }
}

if (isset($_POST['email'])) {
  $respond = new formAjax;
  $respond->tempEmail = $_POST['email'];
  $respond->validateEmail();
}