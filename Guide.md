# Quick Guide
Below is a quick documentation guide on how to use the Query Builder by SquidQuery script.

# Connect to Database
```php
<?php
/**
 * Author   : Afid Arifin
 * Email    : affinbara@gmail.com
 * Version  : v1.1
 */
require_once 'src/Server.php';
require_once 'src/Database.php';

$database = new Database([
  'local' => [
    'driver'  => 'mysql',
    'host'    => '127.0.0.1:3306',
    'user'    => 'root',
    'pass'    => '',
    'name'    => '',
    'port'    => 3306,
    'charset' => 'utf8mb4',
    'mode'    => [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ],
  ],
]);

$db = $database->connect('local');
?>
```
