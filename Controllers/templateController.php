<?php

class templateController {

  /**
   * Llamada al template
   */
  public function getTemplate() {

    # include(): invoca el archivo que contiene código html-php
    include 'Views/template.php';
  }
}
