<?php
// Teste SELECT tabela do banco

  $host = "127.0.0.1";
  $db = "phppdo";
  $user = "user";
  $pass = "123";
  $charset = "utf8mb4";
  
  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  
  try {
      $pdo = new PDO($dsn, $user, $pass, $options);
      $stmt = $pdo -> prepare("SELECT * FROM estoque");
      $stmt-> execute();

      while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
        echo $row["id"] . " - " . $row["produto"] . $row["cor"] . " - " . $row["tamanho"] . $row["deposito"] . " - " . $row["data_disponibilidade"] . " - " . $row["quantidade"] . PHP_EOL;
      }
  } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }
?>