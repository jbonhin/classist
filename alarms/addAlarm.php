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

if(!empty($dados['SendAddAlarm'])){
  $empty_input = false;
  $dados = array_map('trim', $dados);

  if (in_array("",$dados)) {
    $empty_input = true;
    // Mensagem de erro
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'><h4>Erro: Necessário preencher todos os campos!</h4></div>";
      
    //Redirecionar o usuario
    header("Location: formAddAlarm.php");
  }

  if (!$empty_input) {

    $date = date('Y/m/d H:i:s');
      
    $dataAlarm = [
      'alarm_description' => $dados['alarm_description'],
      'equipment_name' => $dados['equipamento'],
      'alarm_status' => "Desativado",
      'alarm_class' => $dados['classif'],
      'created_at' => $date
    ];

    $query_alarme = "INSERT INTO alarm 
                (
                  alarm_description, 
                  equipment_name, 
                  alarm_status, 
                  alarm_class,
                  created_at
                ) VALUES
                (
                  :alarm_description, 
                  :equipment_name, 
                  :alarm_status, 
                  :alarm_class,
                  :created_at
                )";

    $cad_alarme = $conn->prepare($query_alarme);

    
    $cad_alarme->bindParam(':alarm_description', $dataAlarm['alarm_description'], PDO::PARAM_STR);
    $cad_alarme->bindParam(':equipment_name', $dataAlarm['equipment_name'], PDO::PARAM_STR);
    $cad_alarme->bindParam(':alarm_status', $dataAlarm['alarm_status'], PDO::PARAM_STR);
    $cad_alarme->bindParam(':alarm_class', $dataAlarm['alarm_class'], PDO::PARAM_STR);
    $cad_alarme->bindParam(':created_at', $dataAlarm['created_at'], PDO::PARAM_STR);
    
    if($cad_alarme->execute()){
      /*
id
alarm_description
equipment_name
alarm_status
entry_date
departure_date
*/	


      // Criar a SESSÃO com o mensagem de sucesso
      $_SESSION['msg'] = "<div class='alert alert-success' role='alert'><h4>Alarme cadastrado com sucesso</h4></div>";
      

      //Redirecionar o usuario
      header("Location: formAddAlarm.php");
    } else {
      //Criar a variavel global para salvar a mensagem de erro
      $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'><h4>Erro: Alarme não cadastrado!</h4></div>";
      
      //Redirecionar o usuario
      header("Location: formAddAlarm.php");
    }

    # code...
  }
}else{
    //Criar a variavel global para salvar a mensagem de erro
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'><h4>Erro: Alarme não cadastrado!</h4></div>";

    //Redirecionar o usuario
    header("Location: formAddAlarm.php");
}
?>