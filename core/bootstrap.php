<?php 

use App\Core\App;
use App\Core\Session;
use App\Core\Database\{Connection, BaseModel, QueryBuilder};

define('PROJECT_PATH', dirname($_SERVER['DOCUMENT_ROOT']));

App::bind('config', require_once(PROJECT_PATH . '/config.php'));
App::bind('session', new Session());
App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

BaseModel::setDatabase(Connection::make(App::get('config')['database']));
