<?php
set_time_limit ( 1200 );
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

// Главный конфиг проекта
define('ROOT_DIR', dirname(__FILE__).'/'); // Корневая папка для файлов проекта
define('LOG_DIR', ROOT_DIR . 'log/'); // Папка для логов
define('TIMEFORMAT','Y-m-d H:i:s');

$paths = array(
     '.',
     ROOT_DIR . 'libs/',
     ROOT_DIR . 'app/'
);
set_include_path(implode(PATH_SEPARATOR, $paths));

ini_set('log_errors', 1);
ini_set('error_log', LOG_DIR.'/php-errors.log');
ini_set('html_errors', 1);


function __autoload($class_name)
{
    $path = str_replace("_", "/", $class_name);
    require_once $path.".php";
    return;
}
?>
