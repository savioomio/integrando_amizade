
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href= "style/perfil.css">
    <script type="module" src="../javascript/dark_nuvem_lista.js"></script>
</head>
<body>
    <main>
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
        <section id="area_editavel">
            <section id="img_perfil">
                <div id="foto_perfil">

                </div>
            </section>
            <section id="dados_perfil">
                <div id="info_usuario">
                <?php get_perfil($conn, $_GET['id']);?>
                </div>
                <div id="botao_editar_perfil">
                    <button type="submit" id="editar_perfil">Editar Perfil</button>
                </div>
            </section>
        </section>
        <section id="area_desempenho">
            <div class="info_desempenho">
                <div id="titulo">Pontos Adquiridos</div>
                <div id="conteudo">Você ainda não possui Pontos</div>
            </div>
            <div class="info_desempenho">
                <div id="titulo">Gráfico Desempenho</div>
                <div id="conteudo">Você ainda não possui Pontos</div>
            </div>
        </section>
        <section class="navigation">
            <ul>
            <li class="list active">
                    <a href="perfil.php">
                        <span class="icon">
                            <ion-icon name="person-circle-sharp"></ion-icon>
                        </span>
                        <span class="text">Perfil</span>
                    </a>
                </li>

                <li class="list">
                    <a href="../index.php">
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
                <li class="list">
                    <a href="./inicio.php">
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
</body>
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
    --azulLua: #005ea6;
    --corFundo: #2E3834;
    --corQuadros: #3A4540;
    --navegation: #222327;
}
.white-mode:root {
    --corTexto: black;
    --corFundo: #E8E8E8;
    --corQuadro: #BDBDBD;
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
    margin: 3vh 5vw 2vh 5vw;
}

section#logo>img {
    height: 30px;
    filter: drop-shadow(3px 2px 0px #004B83);
}
section#area_editavel {
    display: flex;
    width: 100%;
    height: 25vh;
    background-color: transparent;
}
section#img_perfil {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    height: 100%;
    padding-right: 10px;
    width: 40%;
    background-color: transparent; 
}
div#foto_perfil{
    width: 60%;
    height: 50%;
    border-radius: 8px;
    background-color:var(--corQuadros); 
}
section#dados_perfil{
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 60%;
    height: 100%;
    background-color:transparent; 
}
div#info_usuario{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    width: 100%;
    padding: 5px;
    color: var(--corTexto);
}
p#texto_email{
    font-size: 8pt;
}
div#botao_editar_perfil{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
    padding: 5px;
}
button#editar_perfil{
    width: 110px;
    padding: 5px;
    border-radius: 5px;
    background-color: var(--corAzul);
    color: var(--corTexto);
    border: none;
}
section#area_desempenho{
    width: 100%;
    height: 55vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
}
div.info_desempenho{
    width: 70%;
    height: 10vh;
    border-radius: 5px;
    background-color: var(--corQuadros);
    padding: 5px;
    color: var(--corTexto);
    font-size: 10pt;
    margin: 5px;
}
div#titulo{
    border-bottom:solid 1px rgba(255, 255, 255, 0.671);
    font-size: 13pt;
}
.navigation {
    width: 100%;
    height: 70px;
    background: var(--navegation);
    position: relative;
    display: flex;
    justify-content: center;
    /* position: ;
    bottom: 0px;
    display: flex;
    justify-content: center;
    align-items: center; */
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
    background-color: var(--azulLua);
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

</style>
</html>

