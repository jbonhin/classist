<?php

session_start();

//Incluir a conexao com BD
//include_once( "config.php");
include_once( "../core/connection.php");

//Receber os dados do formulario
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
  
  $query_del_alarm = "DELETE FROM alarm WHERE id=:id";
  $cad_del_alarm = $conn->prepare($query_del_alarm);
  $cad_del_alarm->bindParam(':id', $id);

  if ($cad_del_alarm->execute()) {
    $_SESSION['msg'] = '
    <div class="alert alert-warning" role="alert">
      <h4>Alarme definitivamente eliminado!<h4>
    </div>
    ';
    header("Location: listAlarms.php");  
  } else {
    $_SESSION['msg'] = '
    <div class="alert alert-danger" role="alert">
      <h4>Erro: Alarme não foi apagado, verificar os dados digitados!</h4>
    </div>
    ';
    header("Location: index.php");  
  }
} else {
	$_SESSION['msg'] = '
  <div class="alert alert-danger" role="alert">
    <h4>Necessário selecionar um alarme</h4>
  </div>
  ';
	header("Location: index.php");
}
