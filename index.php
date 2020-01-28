<?php
/**
 * INDEX: En él mostraremos la salida de las vistas  al usuario
 *  y también enviaremos las distintas acciones que el usuario envie al controlador
 *
 * require(): Establece que el código del archivo invocado es requerido
 *  para el funcionamiento del programa.
 */

require_once 'Controllers/templateController.php';
require_once 'Controllers/formController.php';
require_once 'Models/forms.php';

$template = new templateController;

$template->getTemplate();
