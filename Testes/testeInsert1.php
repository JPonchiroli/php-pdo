<?php
// Teste de inserção de dados no banco

  $host = '127.0.0.1';
  $db = 'phppdo';
  $user = 'user';
  $pass = '123';
  $charset = 'utf8mb4';
  
  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  
  try {
      $pdo = new PDO($dsn, $user, $pass, $options);
      $stmt = $pdo -> prepare("INSERT INTO estoque (produto, cor, tamanho, deposito, data_disponibilidade, quantidade) 
                              VALUES (:produto, :cor, :tamanho, :deposito, :data_disponibilidade, :quantidade)");

      $produto = "10.01.0419";
      $cor = "00";
      $tamanho = "P";
      $deposito = "DEP1";
      $data_disponibilidade = "2023-05-01";
      $quantidade = "15";

      $stmt -> bindParam(':produto', $produto);
      $stmt -> bindParam(':cor', $cor);
      $stmt -> bindParam(':tamanho', $tamanho);
      $stmt -> bindParam(':deposito', $deposito);
      $stmt -> bindParam(':data_disponibilidade', $data_disponibilidade);
      $stmt -> bindParam(':quantidade', $quantidade);

      $stmt -> execute();
      echo "Usuário Inserido com Sucesso";
  } catch (\PDOException $e) {
      echo 'Erro: ' . $e -> getMessage();
  }
?>