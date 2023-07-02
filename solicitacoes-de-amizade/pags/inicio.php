<?php
// Define as credenciais para acessar o banco de dados
$usernameBD = 'root';
$passwordBD = '';

try {
  // Cria uma nova conexão com o banco de dados utilizando o PDO
  $conn = new PDO('mysql:host=localhost;dbname=base_json', $usernameBD, $passwordBD);
  // Define o modo de tratamento de erros como exceções
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // Caso ocorra algum erro ao conectar no banco, mostra uma mensagem de erro
  echo 'ERROR: ' . $e->getMessage();
}

function get_users($conn, $search_term = null) {
  $sql = "SELECT * FROM usuario";
  if ($search_term) {
      $sql .= " WHERE username LIKE :search_term";
  }
  $sql .= " ORDER BY username ASC";
  
  $stmt = $conn->prepare($sql);
  if ($search_term) {
      $stmt->bindValue(':search_term', $search_term . '%');
  }
  
  $stmt->execute();
  $get = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $total = count($get);

  if ($total > 0) {
      foreach ($get as $dados) {
          echo "<div style='box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); padding: 10px; margin-bottom: 10px;'>";
          echo "<a href='?pagina=perfil&id={$dados['username']}'>{$dados['username']}</a><br>";
          echo $dados["prenome"] . " " . $dados["sobrenome"] . "<br>";
          echo "</div>";
      }
  } else {
      echo "Nenhum resultado encontrado";
  }
}

// Função para obter os resultados da pesquisa
function searchUsers($search_term, $conn) {
  // Preparando a consulta SQL
  $sql = "SELECT * FROM usuario WHERE username LIKE :search_term OR prenome";

  // Preparando a declaração PDO
  $stmt = $conn->prepare($sql);

  // Vinculando o valor do parâmetro
  $stmt->bindValue(':search_term', $search_term . '%');

  // Executando a consulta SQL
  $stmt->execute();

  // Obtendo os resultados
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $results;
}

if (isset($_POST['search'])) {
  $search_term = $_POST['search'];

  // Verificando se o termo de pesquisa não está vazio
  if (!empty($search_term)) {
    // Obtendo os resultados da pesquisa
    $results = searchUsers($search_term, $conn);

    // Verificando se a consulta retornou resultados
    if (count($results) > 0) {
      // Exibe os usuários cadastrados
      echo "Usuários Cadastrados: <br>";
      echo "<div style='box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); padding: 10px; margin-bottom: 10px;'>";
      get_users($conn, $search_term);
      echo "</div>";
    } else {
      echo "Nenhum resultado encontrado";
    }
  } else {
    echo "Digite um nome de usuário para pesquisar";
  }

  echo "<br>";

  // Encerrar o script aqui, pois a resposta será tratada pelo JavaScript
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amigos</title>
</head>

<body>
  <br>
  <form id="form_pesquisa" method="post">
    <div class="form-inline my-2 my-lg-0">
      <input type="search" name="search" placeholder="Digite um nome de usuário..." onkeypress="handleKeyPress(event)" oninput="searchUsers(this.value)">
    </div>
  </form>
  <br>
  <br>
  <div id="search_results"></div>
  <br>
  <a href="?pagina=solicitacoes">Solicitações de amizade<?php echo return_total_solicitation($conn); ?></a>
  <script>
    function searchUsers(searchTerm) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById("search_results").innerHTML = xhr.responseText;
        }
      };
      xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("search=" + searchTerm);
    }
    
    function handleKeyPress(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        searchUsers(event.target.value);
      }
    }
  </script>
</body>

</html>
