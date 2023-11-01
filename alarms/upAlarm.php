<?php

// Definir um fuso horario padrao
date_default_timezone_set('America/Sao_Paulo');

session_start(); //Iniciar a sessao

//Limpar o buffer de saida
ob_start();

//Incluir a conexao com BD

//require "config.php";
require "../core/connection.php";

//Receber os dados do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuario clicou no botao
if(!empty($dados['SendUpAlarm'])){
  $empty_input = false;
  $dados = array_map('trim', $dados);
  
  $date = date('Y/m/d H:i:s');

  if (empty($dados['eqp_up'])) {
    $eqp_up = $dados['equipment_name'];
  } else {
    $eqp_up = $dados['eqp_up'];
  }

  //if (empty($dados['situacao'])) {
    $alarm_status = $dados['alarm_status'];
  //} else {
    //$alarm_status = $dados['situacao'];
  //}

  if (empty($dados['classif'])) {
    $alarm_class = $dados['alarm_class'];
  } else {
    $alarm_class = $dados['classif'];
  }
  
  $dataAlarm = [
    'id' => $dados['id_alarm'],
    'alarm_description' => $dados['alarm_description'],
    'equipment_name' => $eqp_up,
    'alarm_status' => $alarm_status,
    'alarm_class' => $alarm_class,
    'modified_at' => $date
  ];

  $query_up_alarm = "UPDATE alarm
  SET 
    alarm_description=:alarm_description, 
    equipment_name=:equipment_name, 
    alarm_status=:alarm_status, 
    alarm_class=:alarm_class,
    modified_at=:modified_at
  WHERE 
  id=:id";
  

  $cad_up_alarm = $conn->prepare($query_up_alarm);

  $cad_up_alarm->bindParam(':id', $dataAlarm['id']);
  $cad_up_alarm->bindParam(':alarm_description', $dataAlarm['alarm_description']);
  $cad_up_alarm->bindParam(':equipment_name', $dataAlarm['equipment_name']);
  $cad_up_alarm->bindParam(':alarm_status', $dataAlarm['alarm_status']);
  $cad_up_alarm->bindParam(':alarm_class', $dataAlarm['alarm_class']);
  $cad_up_alarm->bindParam(':modified_at', $dataAlarm['modified_at']);
  
  if($cad_up_alarm->execute()){
    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'><h4>Alarme alterado com sucesso</h4></div>";
  }else{
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'><h4>Erro: Alarme não alterado, verificar os dados digitados!<h4></div>";
  }

  header("Location: formUpAlarm.php?id=". $dataAlarm['id']); 
}


