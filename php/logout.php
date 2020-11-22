
<?php

//NOS SIRVE PARA CERRAR LA SESIÓN Y REDIRIGIR AL USUARIO A LA PAGINA DE INDEX
require_once '__varios.php';

session_start();
session_unset();
session_destroy();

redireccionar("/Logistica/Logistica-001/php/");

?>