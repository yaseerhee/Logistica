
<?php
require_once '__varios.php';

session_start();
session_unset();
session_destroy();

redireccionar("/Logistica/Logistica-001/php/");

?>