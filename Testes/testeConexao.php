<?php
// Teste apenas para testar conexão com banco de dados 

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
      echo "Conexão bem-sucedida!";
  } catch (\PDOException $e) {
      echo "Erro: " . $e -> getMessage();
  }
?>