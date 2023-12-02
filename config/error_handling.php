<?php
// Activa la visualización de errores y advertencias
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Función personalizada para manejar errores y advertencias
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "<b>Error/Warning:</b> [$errno] $errstr<br>";
    echo "Error/Warning on line $errline in $errfile<br>";
}

// Configura el manejador de errores personalizado para errores y advertencias
set_error_handler("customErrorHandler");
?>