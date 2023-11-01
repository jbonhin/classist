<?php
session_start();
ob_start();

//require "./config.php";
require "../core/connection.php";
require "./functions.php";


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><h4>Erro: Alarme não alterado!</h4></div>';
}

$query_update_alarm = "
SELECT
    id,
    alarm_description,
    equipment_name,
    alarm_status,
    alarm_class,
    created_at,
    modified_at
FROM
    `alarm`
WHERE
    id = :id;
";

// Executar a QUERY com PDO
$result_update_alarm = $conn->prepare($query_update_alarm);
$result_update_alarm->bindParam(':id', $id);
$result_update_alarm->execute();


if (($result_update_alarm) and ($result_update_alarm->rowCount() !=0)) {
  $row_alarm = $result_update_alarm->fetch(PDO::FETCH_ASSOC);
  //$_SESSION['msg'] = '<div class="alert alert-success" role="alert"><h4>Alarme alterado com sucesso!</h4></div>';
} else {
  // Mensagem de erro
  //$_SESSION['msg'] = '<div class="alert alert-danger" role="alert"><h4>Erro: Alarme não alterado!</h4></div>';
  
  // Retorna ao lista de alarme
  //header("Location: index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">'
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Buscar dados em tempo real com PHP, MySQL e AJAX">
    <meta name="author" content="João">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classist</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.5.min.css">
    <!-- Custom core CSS -->
    <link rel="stylesheet" href="../assets/css/custom.css">

</head>
<body>
  <section class="container py-4 text-left">

    <form method="post">
      <div class="row g-4">

        <div class="col-9">
          <h2 class="">Editar Alarme</h2>
        </div>

        <div class="col-1">
          <input
            type="submit" 
            name="button1"
            class="button button1 btn btn-outline-primary" 
            value="Listar" 
          />
        </div>
            
        <div class="col-1">
          <input 
            type="submit" name="button2"
            class="button btn btn-outline-success" 
            value="Cadastrar" 
          />
        </div>
      </div>
    </form>
    <br><br>

    <?php
      // Acessa o IF quando existir mensagem de erro ou sucesso
      if(isset($_SESSION['msg'])){
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
      }
    ?>

    <form id="update_alarm" method="POST" action="upAlarm.php">

      <div class="form-group new-alarm">
        
        <input  
          type="hidden" 
          name="id_alarm" 
          id="id_alarm" 
          value="<?php 
          if (isset($row_alarm['id'])) {
            echo $row_alarm['id'];
          }
          ?>"
        >
        <label for="alarm_description">
            <span class="text-danger">*</span> 
            <b>Nome do Alarme:</b>
        </label>
        <input 
          class="form-control" 
          type="text" 
          name="alarm_description" 
          id="alarm_description" 
          placeholder="Nome do alarme!" 
          value="<?php 
          if (isset($row_alarm['alarm_description'])) {
            echo $row_alarm['alarm_description'];
          }
          ?>"
        >
        <br>
      </div>

      <div class="form-group">
        <div class="row g-4">

          <div class="col-6">
          <label for="equipment_name">
            <span class="text-danger">*</span> 
            <b>Equipamento:</b>
          </label>
            <input 
              class="form-control new-alarm" 
              type="text" 
              name="equipment_name" 
              id="equipment_name" 
              value="<?php 
              if (isset($row_alarm['equipment_name'])) {
                echo $row_alarm['equipment_name'];
              }
              ?>"
              disabled
            >
            <input  
              type="hidden" 
              name="equipment_name" 
              id="equipment_name" 
              value="<?php 
              if (isset($row_alarm['equipment_name'])) {
                echo $row_alarm['equipment_name'];
              }
              ?>"
              >
          </div>

          <div class="col-6">   
          <label for="equipment_name">
            <span class="text-danger">*</span> 
            <b class="text-danger">
                * Para pesquisar digite os 2 primeiros caracteres em diante!
            </b>
          </label>     
            <input 
              class="form-control new-alarm" 
              type="text" 
              name="eqp_up" 
              id="eqp_up" 
              placeholder="Pesquisar o Equipamento"  
              onkeyup="carregarEquipamentos(2, this.value)" 
              autocomplete="off"
            >            
            
            <span id="resultado-pesquisa"></span>
            
            <!-- Campo oculto que recebe o ID do equipamento selecionado no campo "equipamento" -->
            <input type="hidden" name="id_eqp" id="id_eqp">
          </div>
        </div>
        <br>

        <div class="row g-4">

          <div class="col-6">
            <div class="form-group">
              <label for="alarm_status">
                  <span class="text-danger">*</span> 
                  <b>Situação:</b>
              </label>
              <br>
              <div class="row">

                <div class="col-3">
                  <input 
                    class="form-control text-center"
                    type="text" 
                    name="alarm_status" 
                    id="alarm_status" 
                    value="<?php
                    if (isset($row_alarm['alarm_status'])) {
                      echo $row_alarm['alarm_status'];
                    }
                    ?>"           
                  >
                </div>
                  <!--div class="col-2">
                    <?php
                    /*if (isset($row_alarm['alarm_status'])) {
                      
                      if ($row_alarm['alarm_status'] == "Ativado") {
                        echo '<button type="button" class="btn btn-danger" onclick="alarmStatus(1)">Desativar</button>';
                      } else {
                        echo'<button type="button" class="btn btn-primary"onclick="alarmStatus(2)">Ativar</button>';
                      }
                    }*/
                    ?>
                  </div-->
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="col-3">
            <div class="form-group">
              <label for="id_classif">
                  <span class="text-danger">*</span> <b>Classificação:</b>
              </label>
              <input 
                type="hidden" 
                name="class_alarm" 
                id="class_alarm" 
                value="<?php
                if (isset($row_alarm['alarm_class'])) {
                  
                  echo $row_alarm['alarm_class'];
                }
                ?>"                  
              >
              <select class="form-control new-alarm-class" name="classif" id="id_classif">
                  <?php 
                  if (isset($row_alarm['alarm_class'])) {
                    echo "<option value='". $row_alarm['alarm_class'] ."'>". $row_alarm['alarm_class'] ."</option>";
                    switch ($row_alarm['alarm_class']) {
                      case 'Emergente':
                        echo "<option value='Ordinário'>Ordinário</option>";
                        echo "<option value='Urgente'>Urgente</option>";
                        break;
                    
                      case 'Ordinário':
                        echo "<option value='Emergente'>Emergente</option>";
                        echo "<option value='Urgente'>Urgente</option>";
                        break;
                      
                      case 'Urgente':
                        echo "<option value='Emergente'>Emergente</option>";
                        echo "<option value='Ordinário'>Ordinário</option>";
                        break;
                      
                      default:
                        echo "<option value='Emergente'>Emergente</option>";
                        echo "<option value='Ordinário'>Ordinário</option>";
                        echo "<option value='Urgente'>Urgente</option>";
                        break;
                    }
                  }
                  ?>
              </select>
            </div>
          </div>
        </div>
        <br>
        <p>
            <span class="text-danger">*</span> Campo Obrigatório
        </p>
        <br>
        <div class="row g-4">

          <div class="col-auto">
            <input class="btn btn-outline-success btn-sm" name="SendUpAlarm" type="submit" value="Salvar">
          </div>
        
        </div>
      </div>
    </form>
  </section>
  <script src="../assets/js/custom.js"></script>
</body>
</html>