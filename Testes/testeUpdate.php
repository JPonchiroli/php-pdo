<?php
// Teste de alteração de um produto do banco

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

      $dados = json_decode($json_data, true);

     if(json_last_error() === JSON_ERROR_NONE){
      $stmt = $pdo -> prepare("UPDATE estoque
                               SET cor = :cor,
                                   tamanho = :tamanho,
                                   deposito = :deposito,
                                   data_disponibilidade = :data_disponibilidade,
                                   quantidade = :quantidade
                               WHERE id = :id");

        $stmt->bindValue(":cor", $dados["cor"]);
        $stmt->bindValue(":tamanho", $dados["tamanho"]);
        $stmt->bindValue(":deposito", $dados["deposito"]);
        $stmt->bindValue(":data_disponibilidade", $dados["data_disponibilidade"]);
        $stmt->bindValue(":quantidade", $dados["quantidade"]);
        $stmt->bindValue(":id", $dados["id"]);

        $stmt->execute();
      echo "Produto Atualizado com Sucesso";
     } else {
      echo "Erro ao decodificar o JSON: " . json_last_error_msg();
     }
  } catch (\PDOException $e) {
      echo "Erro: " . $e -> getMessage();
  }
?>