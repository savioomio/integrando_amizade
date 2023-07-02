<?php
	session_start();
	$_SESSION['userLogin'] = "mirandinha";
	require_once "lib/conn.php";
	require_once "lib/functions.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SOLICITAÇÕES DE AMIZADE</title>
  </head>
  <body>
    <div class="content">
      <?php carrega_pagina($conn);?>
    </div>
  </body>
</html>