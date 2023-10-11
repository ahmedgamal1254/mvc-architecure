<?php 
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(__DIR__).DS);
define('APP',ROOT.'app'.DS);
define('CORE',APP.'Core'.DS);
define('CONTROLLER',APP.'Controllers'.DS);
define('MODELS',APP.'Models'.DS);
define('VIEWS',APP.'Views'.DS);
define('EMAILS',APP.'Emails'.DS);
define('CONFIG',APP.'Config'.DS);
define('LIBS',APP.'Libs'.DS);
define('ROUTE',APP.'Routes'.DS);

require_once(CONFIG.'app.php');
require_once(APP.DS.'helpers'.DS.'helpers.php');

// autoload all classes
$modules=[ROOT,APP,CORE,CONFIG,LIBS,CONTROLLER,VIEWS,MODELS,EMAILS];
set_include_path(get_include_path().PATH_SEPARATOR.implode(PATH_SEPARATOR,$modules));
spl_autoload_register('spl_autoload');

require_once ROUTE . 'web.php';

try {
    new App($routes->dispatch());
} catch (\Throwable $th) {
    echo $th;
}
