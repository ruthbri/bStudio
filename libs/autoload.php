<?php
spl_autoload_register(function ($clsName) {
    $file = ROOT_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $clsName) . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    } return false;
});