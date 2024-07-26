<?php
// Teste de inserção de um ou mais produtos no banco

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

      $json_data = file_get_contents('php://input');

      $produtos = json_decode($json_data, true);

     if(json_last_error() === JSON_ERROR_NONE){
      $stmt = $pdo -> prepare("INSERT INTO estoque (produto, cor, tamanho, deposito, data_disponibilidade, quantidade) 
                               VALUES (:produto, :cor, :tamanho, :deposito, :data_disponibilidade, :quantidade)");

      foreach ($produtos as $produto) {
        $stmt->bindValue(":produto", $produto["produto"]);
        $stmt->bindValue(":cor", $produto["cor"]);
        $stmt->bindValue(":tamanho", $produto["tamanho"]);
        $stmt->bindValue(":deposito", $produto["deposito"]);
        $stmt->bindValue(":data_disponibilidade", $produto["data_disponibilidade"]);
        $stmt->bindValue(":quantidade", $produto["quantidade"]);

        $stmt->execute();
      }
      echo "Produtos Inserido com Sucesso";
     } else {
      echo "Erro ao decodificar o JSON: " . json_last_error_msg();
     }
  } catch (\PDOException $e) {
      echo "Erro: " . $e -> getMessage();
  }
?>