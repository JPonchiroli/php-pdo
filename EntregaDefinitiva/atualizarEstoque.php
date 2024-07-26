<?php
  
   function atualizarEstoque(){

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

    $pdo = new PDO($dsn, $user, $pass, $options);
        
    $json = file_get_contents('php://input');
    $produtos = json_decode($json, true);

    $sqlUpdate = "UPDATE estoque 
                  SET cor = :cor, tamanho = :tamanho, deposito = :deposito, data_disponibilidade = :data_disponibilidade, quantidade = :quantidade 
                  WHERE produto = :produto";
    $stmtUpdate = $pdo->prepare($sqlUpdate);

    $sqlInsert = "INSERT INTO estoque (produto, cor, tamanho, deposito, data_disponibilidade, quantidade) 
                  VALUES (:produto, :cor, :tamanho, :deposito, :data_disponibilidade, :quantidade)"; 

    $stmtInsert = $pdo->prepare($sqlInsert);

    foreach ($produtos as $produto) {
      try {
          $stmtUpdate->execute($produto);

          if ($stmtUpdate->rowCount() === 0) {
              $stmtInsert->execute($produto);
          }

          echo json_encode(["status" => "success", "message" => "Produto atualizado/inserido com sucesso!"  . PHP_EOL]);
      } catch (PDOException $e) {
          echo json_encode(["status" => "error", "message" => $e->getMessage()]);
      }
  }

}

  atualizarEstoque();
  
?>