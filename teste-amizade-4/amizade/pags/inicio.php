<?php

require_once "conn.php";

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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigos</title>
    <link rel="shortcut icon" href="../img/logo_jsor.png" type="image/x-icon">
    <script type="module" src="../javascript/dark_nuvem_lista.js"></script>
    <link rel="stylesheet" href="./adicionarAmigos.css">
</head>

<body>
  <main class="mainPrincipal">
        <section id="logo">
            <img src="../img/logo.png" alt="logo">
            <div class="toggleWrapper">
                <input type="checkbox" checked class="dn" id="dn">
                <label for="dn" class="toggle">
                    <span class="toggle__handler">
                        <span class="crater crater--1"></span>
                        <span class="crater crater--2"></span>
                        <span class="crater crater--3"></span>
                    </span>
                    <div id="content" class="hidden">
                        <span class="nuvem"></span>
                    </div>
                    <span class="star star--1"></span>
                    <span class="star star--2" id="star2"></span>
                    <span class="star star--3"></span>
                    <span class="star star--4"></span>
                    <span class="star star--5"></span>
                    <span class="star star--6"></span>
                </label>
            </div>


            <!-- <input type="checkbox" name="" id="switch"> -->
        </section>

        <section id="conteudo">
            <article class="imgConteudo margin">
                <img src="" alt="">
            </article>

            <aritcle class="pesAmigos">
                <div class="input-group margin">
                  <form method="post">
                    <div class="">
                      <input required="" autocomplete="off" class="input" id="inputPesquisa" type="search" name="search" onkeypress="handleKeyPress(event)" oninput="searchUsers(this.value)">
                    </div>
                  </form>
  
                    <label class="user-label" id="labelInput">Procurar Amigo</label>

                    <button class="butPesquisa">
                        <ion-icon id="ionButton" name="search-outline"></ion-icon>
                    </button>
                </div>
            </aritcle>

            <article class="margin" id="amigos">
                <aside id="tituloListaAmigos">
                    <p>Seus Amigos</p>
                    <ion-icon name="person-add-sharp"></ion-icon>
                </aside>

                <hr>
                
                <aside>
                    
                  <a href="?pagina=solicitacoes">Solicitações de amizade<?php echo return_total_solicitation($conn); ?></a>

                </aside>
                
                <div id="search_results"></div>
                <!-- <aside id="listaAmigos">
                    <div class="perfil">
                        <img src="#" alt="">
                        <p class="pNomes">Nome</p>
                    </div>
                    <div class="perfil">
                        <img src="#" alt="">
                        <p class="pNomes">Nome</p>
                    </div>
                </aside> -->

            </article>



        </section>


        <section class="navigation">
            <ul>
                <li class="list">
                    <a href="perfil.php">
                        <span class="icon">
                            <ion-icon name="person-circle-sharp"></ion-icon>
                        </span>
                        <span class="text">Perfil</span>
                    </a>
                </li>

                <li class="list">
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="calendar-sharp"></ion-icon>
                        </span>
                        <span class="text">Quadros</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="podium-sharp"></ion-icon>
                        </span>
                        <span class="text">Rankings</span>
                    </a>
                </li>
                <li class="list active">
                    <a href="adicionarAmigos.php">
                        <span class="icon">
                            <ion-icon name="person-add-sharp"></ion-icon>
                        </span>
                        <span class="text">Amigos</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="notifications-sharp"></ion-icon>
                        </span>
                        <span class="text">Notificações</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="time"></ion-icon>
                        </span>
                        <span class="text">Recentes</span>
                    </a>
                </li>

                <div class="indicator"></div>
            </ul>

        </section>

    </main>
    <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
    <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
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

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: var(--corFundo);
}

:root {
    --corTexto: #FFFFFF;
    --corAzul: #004B83;
    --corFundo: #2E3834;
    --corCriarQuadro: #3A4540;
    --navegation: #222327;
}

.white-mode:root {
    --corTexto: black;
    --corFundo: #E8E8E8;
    --corCriarQuadro: #BDBDBD;
    --navegation: #FFFFFF;
}

main.mainPrincipal {
    display: flex;
    flex-direction: column;
    height: 100vh;
    background-color: var(--corFundo);
}

.mainPrincipal>section {
    color: var(--corTexto);
}

section#logo {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    margin: 0vh 5vw 0vh 5vw;
    height: 9vh;
}

section#logo>img {
    height: 30px;
    
    filter: drop-shadow(3px 2px 0px #004B83);
}

section#conteudo {
    display: flex;
    flex-direction: column;
    margin: 2vh 10vw 0vh 10vw;
    font-size: 14px;
}

article.imgConteudo>img {
    width: 100%;
    height: 200px;
    background-color: gray;
}



section#conteudo .margin {
    margin-bottom: 15px;
}

section#conteudo #tituloListaAmigos {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 0px 10px 0px 10px;

}
section#conteudo #listaAmigos {
    padding: 0px 10px 0px 10px;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    align-items: flex-start;
    margin-bottom: 80px;
    /* margin-bottom: 103px; */
}

aside#listaAmigos > .perfil{
    background-color: var(--corCriarQuadro);
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: 5px;
    align-items: center;
    width: calc(33.333% - 10px);
    height: 100px;

}
div.perfil > img {
    width: 100%;
    height: 95%;
}
aside#listaAmigos .pNomes {
    font-size: 12px;

}

article#amigos>hr {
    margin: 3px 0px;
}


.toggleWrapper {
    color: white;
}

.toggleWrapper input {
    display: none;
}

.toggle {
    cursor: pointer;
    display: inline-block;
    position: relative;
    width: 45px;
    height: 27px;
    background-color: #83d8ff;
    border-radius: 40px;
    transition: background-color 200ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
}

/*   
  .toggle:before {
    content: 'AM';
    position: absolute;
    left: -50px;
    top: 15px;
    font-size: 18px;
  }
  
  .toggle:after {
    content: 'PM';
    position: absolute;
    right: -48px;
    top: 15px;
    font-size: 18px;
    color: #749ed7;
  } */

.toggle__handler {
    display: inline-block;
    position: relative;
    z-index: 1;
    top: 3px;
    left: 3px;
    width: 20px;
    height: 20px;
    background-color: #ffcf96;
    border-radius: 50px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .3);
    transition: all 400ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transform: rotate(-45deg);
}

.toggle__handler .crater {
    position: absolute;
    background-color: #e8cda5;
    opacity: 0;
    transition: opacity 200ms ease-in-out;
    border-radius: 100%;
}


/* EDITAR ISSO AQUI */
.toggle__handler .crater--1 {
    top: 3px;
    left: 8px;
    width: 4px;
    height: 4px;
}

.toggle__handler .crater--2 {
    top: 8px;
    left: 11px;
    width: 6px;
    height: 6px;
}

.toggle__handler .crater--3 {
    top: 11px;
    left: 3px;
    width: 4px;
    height: 4px;
}

/* ATÉ AQUI */

.star {
    position: absolute;
    background-color: #fff;
    transition: all 300ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
    border-radius: 50%;
}

/* EDITAR ISSO AQUI */
.star--1 {
    top: 3px;
    left: 10px;
    z-index: 0;
    width: 3px;
    height: 3px;
}

.star--2 {
    top: 5px;
    left: 20px;
    z-index: 0;
    width: 3px;
    height: 3px;
}


.star--3 {
    top: 10px;
    left: 12px;
    z-index: 0;
    width: 3px;
    height: 3px;
}

/* ATÉ AQUI */



.star--4,
.star--5,
.star--6 {
    opacity: 0;
    transition: all 300ms 0 cubic-bezier(0.445, 0.05, 0.55, 0.95);
}

.star--4 {
    top: 15px;
    left: 15px;
    z-index: 0;
    width: 2px;
    height: 2px;
    transform: translate3d(3px, 0, 0);
}

.star--5 {
    top: 17px;
    left: 8px;
    z-index: 0;
    width: 3px;
    height: 3px;
    transform: translate3d(3px, 0, 0);
}

.star--6 {
    top: 20px;
    left: 20px;
    z-index: 0;
    width: 2px;
    height: 2px;
    transform: translate3d(3px, 0, 0);
}

input:checked+.toggle {
    background-color: #749dd6;
}

input:checked+.toggle:before {
    color: #749ed7;
}

input:checked+.toggle:after {
    color: #fff;
}

input:checked+.toggle .toggle__handler {
    background-color: #ffe5b5;
    transform: translate3d(19px, 0, 0) rotate(0);
}

input:checked+.toggle .toggle__handler .crater {
    opacity: 1;
}

input:checked+.toggle .star--1 {
    width: 2px;
    height: 2px;
}

input:checked+.toggle .star--2 {
    width: 4px;
    height: 4px;
    transform: translate3d(-5px, 0, 0);
}

input:checked+.toggle .star--3 {
    width: 2px;
    height: 2px;
    transform: translate3d(-7px, 0, 0);
}

input:checked+.toggle .star--4,
input:checked+.toggle .star--5,
input:checked+.toggle .star--6 {
    opacity: 1;
    transform: translate3d(0, 0, 0);
}

input:checked+.toggle .star--4 {
    transition: all 300ms 200ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
}

input:checked+.toggle .star--5 {
    transition: all 300ms 300ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
}

input:checked+.toggle .star--6 {
    transition: all 300ms 400ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
}

.hidden {
    display: none;
}

#content {
    width: 20px;
    height: 10px;
    position: absolute;
    top: 33%;
    left: 46%;

}

.nuvem {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: white;
    border-radius: 100px;
    z-index: 1;

}


.nuvem::before {
    /* transition: 0.5s ease; */
    content: '';
    position: absolute;
    background-color: white;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    left: 3.5px;
    top: -3px;
    box-shadow: 5.5px 0.5px 0px 2px white;
}

.navigation {
    width: 100%;
    height: 70px;
    background: var(--navegation);
    position: relative;
    /* bottom: 0px; */
    display: flex;
    justify-content: center;
    /* position: fixed;
    bottom: 0px;
    display: flex;
    justify-content: center;
    align-items: center;*/
}


.navigation ul {
    display: flex;
    width: 350px;
}

.navigation ul li {
    position: relative;
    list-style: none;
    width: 70px;
    height: 70px;
    z-index: 1;
}

.navigation ul li a {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100%;
    text-align: center;
    font-weight: 500;
}

.navigation ul li a .icon {
    position: relative;
    display: block;
    line-height: 70px;
    font-size: 1.5rem;
    text-align: center;
    transition: 0.5s;
    color: var(--corTexto);
}

.navigation ul li.active a .icon {
    transform: translateY(-32px);
}

.navigation ul li a .text {
    position: absolute;
    color: var(--corTexto);
    font-weight: 400;
    font-size: 0.75em;
    letter-spacing: 0.05em;
    transition: 0.5s;
    opacity: 0;
    transform: translateY(10px);
}

.navigation ul li.active a .text {
    transform: translateY(10px);
    opacity: 1;
}

.indicator {
    position: absolute;
    top: -50%;
    width: 70px;
    height: 70px;
    background: var(--navegation);
    border-radius: 50%;
    border: 6px solid var(--corFundo);
    transition: 0.5s;
}

.indicator::before {
    content: '';
    position: absolute;
    top: 50%;
    left: -22px;
    width: 20px;
    height: 20px;
    background: transparent;
    border-top-right-radius: 20px;
    box-shadow: 1px -10px 0 0 var(--corFundo);
}

.indicator::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -22px;
    width: 20px;
    height: 20px;
    background: transparent;
    border-top-left-radius: 20px;
    box-shadow: -1px -10px 0 0 var(--corFundo);
}

.navigation ul li:nth-child(1).active~.indicator {
    transform: translateX(calc(-5.6px * 1));
}

.navigation ul li:nth-child(2).active~.indicator {
    transform: translateX(calc(52px * 1));
}

.navigation ul li:nth-child(3).active~.indicator {
    transform: translateX(calc(54.5px * 2));
}

.navigation ul li:nth-child(4).active~.indicator {
    transform: translateX(calc(56.5px * 3));
}

.navigation ul li:nth-child(5).active~.indicator {
    transform: translateX(calc(56.6px * 4));
}

.navigation ul li:nth-child(6).active~.indicator {
    transform: translateX(calc(57px * 5));
}

.input-group {
    position: relative;
}

.input-group ion-icon {
    color: #9e9e9e;
}

.input {
    border: solid 1.5px #9e9e9e;
    border-radius: 10px;
    background: none;
    padding: 3px;
    font-size: 14px;
    width: 100%;
    color: #f5f5f5;
    transition: border 150ms cubic-bezier(0.4, 0, 0.2, 1);
    margin-right: -2rem;
}

.user-label {
    position: absolute;
    left: 15px;
    top: -10px;
    font-size: 12px;
    color: #9e9e9e;
    pointer-events: none;
    transform: translateY(1rem);
    transition: 150ms cubic-bezier(0.4, 0, 0.2, 1);
}

.butPesquisa {
    background-color: var(--corFundo);
    border: none;
    cursor: pointer;
    position: absolute;
    top: 7px;
    color: var(--corTexto);
}

.input:focus,
.input:valid {
    outline: none;
    border: 1.5px solid var(--corTexto);

}

.input:focus~label,
.input:valid~label {
    transform: translateY(-0.4%) scale(0.8);
    background-color: var(--corFundo);
    padding: 0.02em;

}

@media screen and (max-width: 350px) {
    section#quadro label {
        font-size: 0.8em;

    }

    section#quadro>h2 {
        margin-bottom: 3vh;
        font-size: 1em;
        font-weight: normal;
    }

    section#quadro label {
        font-size: 12px;

    }

    div.quadros {
        width: calc(50% - 10px);
        background-color: var(--corCriarQuadro);
        padding: 10px;
        height: 80px;
        margin: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    article.criarQuadro>p {
        font-size: 0.8em;
    }

    section#areaTrabalho>h1 {
        font-size: 1em;

    }

    .navigation {
        width: 100%;
        height: 70px;
        background: var(--navegation);
        position: relative;
        display: flex;
        justify-content: center;
    }

    .navigation ul {
        display: flex;
        width: 240px;
    }

    .navigation ul li {
        position: relative;
        list-style: none;
        width: 70px;
        height: 70px;
        z-index: 1;
    }

    .navigation ul li a {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        text-align: center;
        font-weight: 500;
    }

    .navigation ul li a .icon {
        position: relative;
        display: block;
        line-height: 70px;
        font-size: 1.3rem;
        text-align: center;
        transition: 0.5s;
        color: var(--corTexto);
    }

    .navigation ul li.active a .icon {
        transform: translateY(-34px);
    }

    .navigation ul li a .text {
        position: absolute;
        color: var(--corTexto);
        font-weight: 400;
        font-size: 0.75em;
        letter-spacing: 0.05em;
        transition: 0.5s;
        opacity: 0;
        transform: translateY(10px);
    }

    .navigation ul li.active a .text {
        transform: translateY(13px);
        opacity: 1;
    }

    .indicator {
        position: absolute;
        top: -50%;
        width: 63px;
        height: 63px;
        background: var(--navegation);
        border-radius: 50%;
        border: 6px solid var(--corFundo);
        transition: 0.5s;
    }

    .indicator::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -14px;
        width: 10px;
        height: 20px;
        background: transparent;
        border-top-right-radius: 20px;
        box-shadow: 1px -10px 0 0 var(--corFundo);
    }

    .indicator::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -14px;
        width: 10px;
        height: 20px;
        background: transparent;
        border-top-left-radius: 20px;
        box-shadow: -1px -10px 0 0 var(--corFundo);
    }

    .navigation ul li:nth-child(1).active~.indicator {
        transform: translateX(calc(-11px * 1));
    }

    .navigation ul li:nth-child(2).active~.indicator {
        transform: translateX(calc(29.5px * 1));
    }

    .navigation ul li:nth-child(3).active~.indicator {
        transform: translateX(calc(34.5px * 2));
    }

    .navigation ul li:nth-child(4).active~.indicator {
        transform: translateX(calc(36.5px * 3));
    }

    .navigation ul li:nth-child(5).active~.indicator {
        transform: translateX(calc(37.3px * 4));
    }

    .navigation ul li:nth-child(6).active~.indicator {
        transform: translateX(calc(37.8px * 5));
    }

}


</style>

</body>

</html>


