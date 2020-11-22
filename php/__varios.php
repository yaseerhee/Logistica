
<?php
//*
//CONEXIÓN A LA BASE DE DATOS logistica

function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $identificador = "root";
    $contrasenna = "";
    $bd = "logistica";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage());
        exit('Error al conectar');
    }

    return $pdo;
}

// REDIRECCIONAR AL ARCHIVO QUE LE PONGAMOS
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}
