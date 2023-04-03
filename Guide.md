# Quick Guide
Below is a quick documentation guide on how to use the Query Builder by SquidQuery script.

### Connect to Database
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
### Retrieving Results
```php
$users = $db->table('users')->get();
foreach($users as $user) {
  echo $user->name;
}

$users = $db->table('users')->all();
foreach($users as $user) {
  echo $user->name;
}
```
### Retrieving a Single
```php
$user = $db->table('users')
->where('id', 1)
->get();
echo $user->name;

$user = $db->table('users')
->where('id', 1)
->select('name, surname')
->get();
echo $user->name.' '.$user->surname;
```
### Forcing to Array
```php
$user = $db->table('users')
->where('id', 1)
->all();
foreach($users as $user) {
  echo $user->name;
}

$user = $db->table('users')
->where('id', '>', 1)
->all();
foreach($users as $user) {
  echo $user->name;
}
```
### Agregates
```php
$avg = $db->table('orders')->avg('price');
echo $avg;

$sum = $db->table('orders')->sum('price');
echo $sum;

$min = $db->table('orders')->min('price');
echo $min;

$max = $db->table('orders')->max('price');
echo $max;

$count = $db->table('orders')->count();
echo $count;
```
### Where Conditions
```php
$users = $db->table('users')
->where('id', '>', 1)
->get();

$user = $db->table('users')
->where('id', 1)
->get();

$user = $db->table('users')
->where('country', 'Italy')
->and('name', 'LIKE', '%David%')
->get();
```
### OR Condition
```php
$user = $db->table('users')
->where('country', 'Italy')
->or('country', 'Spain')
->get();
```
### AND/OR closure
```php
$user = $db->table('users')
->where('country', 'Italy')
->and(function($query) {
  $query->where('country', 'Spain')
  ->or('country', 'France')
})->get();
```
### BETWEEN Condition
```php
$user = $db->table('users')
->whereBetween('age', [20, 30])
->get();

$user = $db->table('users')
->whereNotBetween('age', [20, 30])
->get();
```
### IN Condition
```php
$user = $db->table('users')
->whereIn('age', [20, 30])
->get();

$user = $db->table('users')
->whereNotIn('age', [20, 30])
->get();
```
### IS NULL Condition
```php
$user = $db->table('users')
->whereNull('updated_at')
->get();

$user = $db->table('users')
->whereNotNull('updated_at')
->get()
```
### Raw Where
```php
$users = $db->table('users')
->rawWhere('WHERE age = :age AND role = :role', [
  'age' => 20,
  'role' => 1
])->get();
```
### Join Condition
```php
$users = $db->table('users')
->leftJoin('roles ON roles.id = users.role_id')
->select('users.*', 'roles.name')
->get();
```
### Insert
```php
$lastInsertedId = $db->table('users')
->insert([
  'name' => 'Name', 
  'surname' => 'Surname'
])->lastId();
```
### Update
```php
$update = $db->table('users')
->where('id', 1)
->update([
  'name' => 'Name', 
  'surname' => 'Surname'
])->exec();
```
### Delete
```php
$delete = $db->table('users')
->where('id', 1)
->delete()
->exec();
```
### Truncate
```php
$users = $db->table('users)
->truncate()
->exec();
```
### Group
```php
$users = $db->table('users')
->groupBy('role')
->get();
```
### Order
```php
$users = $db->table('users')
->orderBy('id DESC')
->get();
```
### Limit
```php
$users = $db->table('users')
->limit('0, 10')
->get();
```
### Offset
```php
$users = $db->table('users')
->limit('10')
->offset(5)
->get();
```
### Raw Query
```php
$users = $db->query("
  SELECT users.*, roles.name
  FROM users
  LEFT JOIN roles ON roles.id = users.role_id
  WHERE users.city = :city
  ORDER BY users.id DESC
")->values([
  'city' => 'Naples'
])->get();
```
### Debug
```php
$fruits = $db->table('fruit')
->where('calories', '<', 30)
->and('colour', 'red')
->select('name', 'colour', 'calories')
->debug()
```
