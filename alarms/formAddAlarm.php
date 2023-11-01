<?php
session_start(); // Iniciar a sessão

//include "./loadAlarms.php";
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
    <link rel="stylesheet" href="../assets/css/bootstrap.5.min.css" />
    <!-- Custom core CSS -->
    <link rel="stylesheet" href="../assets/css/custom.css" />

</head>
<body>
  <section class="container py-4 text-left">

    <h2 class="text-center">Novo Alarme</h2>

    <?php
      // Acessa o IF quando existir mensagem de erro ou sucesso
      if(isset($_SESSION['msg'])){
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
      }
    ?>

    <form id="add_alarm" method="POST" action="./addAlarm.php">

      <div class="form-group new-alarm">
          <label for="alarm_description">
              <span class="text-danger">*</span> 
              <b>Nome do Alarme:</b>
          </label>
          <input 
            class="form-control" 
            type="text" 
            name="alarm_description" 
            id="alarm_description" 
            placeholder="Digite o nome do alarme!" 
            value=""
          >
          <br>
      </div>
      
      <div class="form-group">
        <div class="row g-4">
          <div class="col-auto">
            <label for="equipamento">
              <span class="text-danger">*</span> <b>Equipamento:</b>
            </label>
            
            <input 
              class="form-control new-alarm" 
              type="text" name="equipamento" 
              id="equipamento" 
              placeholder="Pesquisar o Equipamento"  
              onkeyup="carregarEquipamentos(1, this.value)" 
              autocomplete="off"
            >

            <p class="text-danger">
                * Para pesquisar digite os 2 primeiros caracteres em diante!
            </p>
          </div>

          <div class="col-auto">
            <br>
            <span id="resultado-pesquisa"></span>
            <!-- Campo oculto que recebe o ID do equipamento selecionado no campo "equipamento" -->
            <input type="hidden" name="id_eqp" id="id_eqp">
          </div>
        </div>
      </div>

      <!--div class="form-group">
          <label for="alarm_status">
              <span class="text-danger">*</span> <b>Situação:</b>
          </label>
          <select class="form-control new-alarm-class" name="alarm_status" id="id_alarm_status">
              <option value="">Selecione</option>
              <option value='Ativado'>Ativado</option>
              <option value='Desativado'>Desativado</option>
          </select>
          <br>
      </div-->

      <div class="form-group">
          <label for="id_classif">
              <span class="text-danger">*</span> <b>Classificação:</b>
          </label>
          <select class="form-control new-alarm-class" name="classif" id="id_classif">
              <option value="">Selecione</option>
              <option value='Emergente'>Emergente</option>
              <option value='Ordinário'>Ordinário</option>
              <option value='Urgente'>Urgente</option>
          </select>
          <br>
      </div>

      <p>
          <span class="text-danger">*</span> Campo Obrigatório
      </p>
      <br>
      <div class="row g-4">

        <div class="col-auto">
          <input class="btn btn-outline-success btn-sm" name="SendAddAlarm" type="submit" value="Salvar">
        </div>
      
        <div class="col-auto">
            <a href="./listAlarms.php" class="btn btn-outline-primary btn-sm">Voltar</a>
        </div>
      </div>
    </form>
  </section>
  <script src="../assets/js/custom.js"></script>
</body>
</html>