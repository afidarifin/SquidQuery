<?php
/**
 * Author   : Afid Arifin
 * Email    : affinbara@gmail.com
 * Version  : v1.1
 */
require_once 'QueryBuilder.php';
require_once 'Query.php';

class Server {
  private $pdo;
  
  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  public function table(string $table): QueryBuilder {
    return new QueryBuilder($this->pdo, $table);
  }

  public function query(string $query): Query {
    return (new Query($this->pdo))->query($query);
  }
}
?>