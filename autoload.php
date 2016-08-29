<?php
function __autoload($class)
{
    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)){
        require $path;
    }
}