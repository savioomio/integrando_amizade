<?php

require_once "conn.php";

function carrega_pagina($conn) {
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'inicio';
    $dir = "pags/";
    $ext = ".php";

    if (file_exists($dir . $pagina . $ext)) {
        include($dir . $pagina . $ext);
    } else {
        echo "<div>Página não encontrada</div>";
    }
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

/*function get_users($conn, $search_term = null) {
    $sql = "SELECT * FROM usuario";
    if ($search_term) {
        $sql .= " WHERE username LIKE :search_term";
    }
    $sql .= " ORDER BY username DESC";
    
    $stmt = $conn->prepare($sql);
    if ($search_term) {
        $stmt->bindValue(':search_term', '%' . $search_term . '%');
    }
    
    $stmt->execute();
    $get = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = count($get);

    if ($total > 0) {
        foreach ($get as $dados) {
            echo "<a href='?pagina=perfil&id={$dados['username']}'>{$dados['username']}</a><br>";
        }
    }
}*/


function get_perfil($conn, $perfil) {
    $sql = $conn->prepare("SELECT * FROM usuario WHERE username = ?");
    $sql->bindParam(1, $perfil);
    $sql->execute();
    $get = $sql->fetchAll(PDO::FETCH_ASSOC);
    $total = count($get);

    if ($total > 0) {
        $dados = $get[0];
        echo "<h4>{$dados['prenome']} <small>@{$dados['username']}</small></h4>";
        verfica_solicitacoes($conn, $_SESSION['userLogin'], $perfil);
    }
}

function verifica_amizade($conn, $username_de, $usaername_para) {
    $sql = $conn->prepare("SELECT * FROM amigo WHERE username_de = ? AND usaername_para = ? AND status = 0");
    $sql->bindParam(1, $username_de);
    $sql->bindParam(2, $usaername_para);
    $sql->execute();

    return count($sql->fetchAll(PDO::FETCH_ASSOC));
}

function send_solicitation($conn, $usaername_para) {
    if (verifica_amizade($conn, $_SESSION['userLogin'], $usaername_para) <= 0) {
        $sql = $conn->prepare("INSERT INTO amigo (username_de, usaername_para) VALUES (?, ?)");
        $sql->bindParam(1, $_SESSION['userLogin']);
        $sql->bindParam(2, $usaername_para);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            redireciona("?pagina=perfil&id={$usaername_para}");
        } else {
            return false;
        }
    } else {
        redireciona("?pagina=perfil&id={$usaername_para}");
    }
}

function verfica_solicitacoes($conn, $username_de, $usaername_para) {
    $sql = $conn->prepare("SELECT * FROM amigo WHERE (username_de = ? AND usaername_para = ?) OR (usaername_para = ? AND username_de = ?)");
    $sql->bindParam(1, $username_de);
    $sql->bindParam(2, $usaername_para);
    $sql->bindParam(3, $username_de);
    $sql->bindParam(4, $usaername_para);
    $sql->execute();
    $get = $sql->fetchAll(PDO::FETCH_ASSOC);
    $total = count($get);

    if ($total > 0) {
        $dados = $get[0];

        if ($dados['status'] == 1) {
            echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}' class='btn btn-danger btn-sm'>Desfazer Amizade</a>";
        }

        if ($dados['usaername_para'] == $usaername_para && $dados['username_de'] == $username_de && $dados['status'] == 0) {
            echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}' class='btn btn-warning btn-sm'>Cancelar Solicitação</a>";
        }

        if ($dados['username_de'] == $usaername_para && $dados['usaername_para'] == $username_de && $dados['status'] == 0) {
            echo "<a href='?pagina=aceitar-amizade&id={$dados['username_de']}' class='btn btn-success btn-sm'>Aceitar Solicitação</a>";
            echo "<a href='?pagina=desfazer-amizade&id={$dados['id']}' class='btn btn-danger btn-sm'>Recusar Solicitação</a>";
        }
    } else if ($total <= 0 && $usaername_para != $username_de) {
        echo "<a href='?pagina=solicitar-amizade&id={$usaername_para}' class='btn btn-success btn-sm'>Adicionar Amigo</a>";
    }
}

function deleta_solicitacao($conn, $id) {
    $sql = $conn->prepare("DELETE FROM amigo WHERE id = ?");
    $sql->bindParam(1, $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        redireciona("?pagina=inicio");
    } else {
        return false;
    }
}

function recusar_solicitacao($conn, $id) {
    $sql = $conn->prepare("DELETE FROM amigo WHERE id = ?");
    $sql->bindParam(1, $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        redireciona("?pagina=solicitacoes");
    } else {
        return false;
    }
}

function aceita_solicitacao($conn, $username_de) {
    $sql = $conn->prepare("SELECT * FROM amigo WHERE username_de = ? AND usaername_para = ? AND status = 0");
    $sql->bindParam(1, $username_de);
    $sql->bindParam(2, $_SESSION['userLogin']);
    $sql->execute();
    $get = $sql->fetchAll(PDO::FETCH_ASSOC);
    $total = count($get);

    if ($total > 0) {
        $dados = $get[0];

        if ($dados['usaername_para'] == $_SESSION['userLogin']) {
            if (atualiza_solicitacao($conn, $username_de, $_SESSION['userLogin']) > 0) {
                redireciona("?pagina=perfil&id={$username_de}");
            } else {
                echo "erro ao atualizar;";
            }
        } else {
            return false;
        }
    }
}

function atualiza_solicitacao($conn, $username_de, $usaername_para) {
    $sql = $conn->prepare("UPDATE amigo SET status = 1 WHERE username_de = ? AND usaername_para = ?");
    $sql->bindParam(1, $username_de);
    $sql->bindParam(2, $usaername_para);
    $sql->execute();

    return $sql->rowCount();
}

function redireciona($dir) {
    echo "<meta http-equiv='Refresh' content='0; url={$dir}'/>";
}

function solicitacoes($conn) {
    if (isset($_SESSION['userLogin'])) {
        $sql = $conn->prepare("SELECT * FROM amigo WHERE usaername_para = ? AND status = 0");
        $sql->bindParam(1, $_SESSION['userLogin']);
        $sql->execute();
        $get = $sql->fetchAll(PDO::FETCH_ASSOC);
        $total = count($get);

        if ($total > 0) {
            foreach ($get as $dados) {
                echo "
                    <ul>
                        <li style='list-style:none;'>
                        <a href='?pagina=perfil&id={$dados['username_de']}' target='_blank'>
                        {$dados['username_de']} 
                        <a href='?pagina=aceitar-amizade&id={$dados['username_de']}' class='btn btn-success btn-sm'>Aceitar Solicitação</a> 
                        <a href='?pagina=recusar-solicitacao&id={$dados['id']}' class='btn btn-danger btn-sm'>Recusar Solicitação</a>
                        </a>
                        </li>
                    </ul>";
            }
        }
    } else {
        exit();
    }
}

function return_total_solicitation($conn) {
    $sql = $conn->prepare("SELECT * FROM amigo WHERE usaername_para = ? AND status = 0");
    $sql->bindParam(1, $_SESSION['userLogin']);
    $sql->execute();
    $get = $sql->fetchAll(PDO::FETCH_ASSOC);
    $total = count($get);

    if ($total > 0) {
        return ": ".$total;
    }
}
